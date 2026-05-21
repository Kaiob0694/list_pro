// ── Máscara de valor ──
const inputValor = document.getElementById("valor");

inputValor.addEventListener("input", (e) => {
  let digits = e.target.value.replace(/\D/g, "");
  if (!digits) { e.target.value = ""; return; }
  let numero = parseInt(digits, 10) / 100;
  e.target.value = numero.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
});

// ── Toast ──
function toast(msg, tipo = "success") {
  const el = document.getElementById("toast");
  el.textContent = msg;
  el.className = `toast ${tipo} show`;
  setTimeout(() => el.classList.remove("show"), 3000);
}

// ── Salvar produto ──
document.getElementById("btnSalvar").addEventListener("click", () => {
  const nome  = document.getElementById("nome").value.trim();
  const valor = document.getElementById("valor").value;

  if (!nome || !valor) {
    toast("Preencha todos os campos!", "error");
    return;
  }

  const valorLimpo = valor.replace(/[R$\s.]/g, "").replace(",", ".");

  fetch("salvar_produto.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ nome, valor: valorLimpo })
  })
  .then(r => r.json())
  .then(dados => {
    toast(dados.mensagem);
    document.getElementById("nome").value  = "";
    document.getElementById("valor").value = "";
    listarProdutos();
  })
  .catch(() => toast("Erro ao salvar.", "error"));
});

// ── Listar produtos ──
function listarProdutos() {
  fetch("listar_produtos.php")
  .then(r => r.json())
  .then(produtos => {
    const container = document.getElementById("listaProdutos");

    if (!produtos.length) {
      container.innerHTML = '<p class="empty">Nenhum produto cadastrado ainda.</p>';
      return;
    }

    container.innerHTML = produtos.map(p => {
      const preco = parseFloat(p.valor).toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
      return `
        <div class="produto-card">
          <div>
            <div class="nome">${p.nome}</div>
            <div class="preco">${preco}</div>
          </div>
          <button class="btn btn-danger" onclick="removerProduto(${p.id})">🗑 Remover</button>
        </div>
      `;
    }).join("");
  })
  .catch(() => toast("Erro ao carregar produtos.", "error"));
}

// ── Remover produto ──
function removerProduto(id) {
  if (!confirm("Remover este produto?")) return;

  fetch("remover_produto.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id })
  })
  .then(r => r.json())
  .then(dados => {
    toast(dados.mensagem);
    listarProdutos();
  })
  .catch(() => toast("Erro ao remover.", "error"));
}

listarProdutos();