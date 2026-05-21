// ── Máscara de valor ──
const inputValorAvulso = document.getElementById("valorAvulso");

inputValorAvulso.addEventListener("input", (e) => {
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

// ── Busca de produtos cadastrados ──
const inputBusca = document.getElementById("busca");

inputBusca.addEventListener("input", () => {
  const termo = inputBusca.value.trim().toLowerCase();

  if (!termo) {
    document.getElementById("resultadoBusca").innerHTML = "";
    return;
  }

  fetch("listar_produtos.php")
  .then(r => r.json())
  .then(produtos => {
    const filtrados = produtos.filter(p =>
      p.nome.toLowerCase().includes(termo)
    );

    const container = document.getElementById("resultadoBusca");

    if (!filtrados.length) {
      container.innerHTML = '<p class="empty">Nenhum produto encontrado.</p>';
      return;
    }

    container.innerHTML = filtrados.map(p => {
      const preco = parseFloat(p.valor).toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
      return `
        <div class="produto-card produto-selecionar" onclick="abrirQtde(${p.id}, '${p.nome}', ${p.valor})">
          <div>
            <div class="nome">${p.nome}</div>
            <div class="preco">${preco}</div>
          </div>
          <span class="add-icon">＋</span>
        </div>
      `;
    }).join("");
  })
  .catch(() => toast("Erro ao buscar produtos.", "error"));
});

// ── Modal de quantidade (inline) ──
function abrirQtde(id, nome, valor) {
  const preco = parseFloat(valor).toLocaleString("pt-BR", { style: "currency", currency: "BRL" });

  const container = document.getElementById("resultadoBusca");
  container.innerHTML = `
    <div class="produto-card" style="flex-direction:column; align-items:flex-start; gap:0.75rem;">
      <div>
        <div class="nome">${nome}</div>
        <div class="preco">${preco} por unidade</div>
      </div>
      <div style="display:flex; align-items:center; gap:1rem; width:100%;">
        <div class="qtde-inline">
          <button onclick="alterarQtde(-1)">−</button>
          <span id="qtdeEscolhida">1</span>
          <button onclick="alterarQtde(1)">+</button>
        </div>
        <button class="btn" style="margin-top:0; flex:1;"
          onclick="adicionarDoCatalogo(${id}, '${nome}', ${valor})">
          Adicionar à lista
        </button>
        <button class="btn btn-danger" onclick="cancelarSelecao()">Cancelar</button>
      </div>
    </div>
  `;
}

function alterarQtde(delta) {
  const el = document.getElementById("qtdeEscolhida");
  const atual = parseInt(el.textContent);
  const nova = Math.max(1, atual + delta);
  el.textContent = nova;
}

function cancelarSelecao() {
  document.getElementById("resultadoBusca").innerHTML = "";
  document.getElementById("busca").value = "";
}

// ── Adicionar produto do catálogo ──
function adicionarDoCatalogo(produto_id, nome, valor) {
  const quantidade = parseInt(document.getElementById("qtdeEscolhida").textContent);

  fetch("adicionar_item.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ produto_id, nome, valor, quantidade })
  })
  .then(r => r.json())
  .then(dados => {
    toast(dados.mensagem);
    cancelarSelecao();
    listarItens();
  })
  .catch(() => toast("Erro ao adicionar.", "error"));
}

// ── Adicionar item avulso ──
document.getElementById("btnAvulso").addEventListener("click", () => {
  const nome      = document.getElementById("nomeAvulso").value.trim();
  const valor     = document.getElementById("valorAvulso").value;
  const quantidade = parseInt(document.getElementById("qtdAvulso").value);

  if (!nome || !valor || !quantidade) {
    toast("Preencha todos os campos!", "error");
    return;
  }

  const valorLimpo = valor.replace(/[R$\s.]/g, "").replace(",", ".");

  fetch("adicionar_item.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ produto_id: null, nome, valor: valorLimpo, quantidade })
  })
  .then(r => r.json())
  .then(dados => {
    toast(dados.mensagem);
    document.getElementById("nomeAvulso").value  = "";
    document.getElementById("valorAvulso").value = "";
    document.getElementById("qtdAvulso").value   = "1";
    listarItens();
  })
  .catch(() => toast("Erro ao adicionar.", "error"));
});

// ── Listar itens da lista ──
function listarItens() {
  fetch("listar_itens.php")
  .then(r => r.json())
  .then(itens => {
    const container  = document.getElementById("listaItens");
    const totalCard  = document.getElementById("totalCard");
    const valorTotal = document.getElementById("valorTotal");
    const qtdItens   = document.getElementById("qtdItens");

    if (!itens.length) {
      container.innerHTML = '<p class="empty">Sua lista está vazia.</p>';
      totalCard.style.display = "none";
      return;
    }

    let total = 0;
    let totalQtd = 0;

    container.innerHTML = itens.map(item => {
      const subtotal = parseFloat(item.valor) * parseInt(item.quantidade);
      total    += subtotal;
      totalQtd += parseInt(item.quantidade);

      const precoUnit  = parseFloat(item.valor).toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
      const precoSub   = subtotal.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });

      return `
        <div class="lista-item">
          <div>
            <div class="item-nome">${item.nome}</div>
            <div class="item-detalhe">${item.quantidade}x ${precoUnit}</div>
          </div>
          <span class="item-subtotal">${precoSub}</span>
          <button class="btn btn-danger" onclick="removerItem(${item.id})">🗑</button>
        </div>
      `;
    }).join("");

    totalCard.style.display = "flex";
    valorTotal.textContent  = total.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
    qtdItens.textContent    = `${totalQtd} ${totalQtd === 1 ? "item" : "itens"} na lista`;
  })
  .catch(() => toast("Erro ao carregar lista.", "error"));
}

// ── Remover item ──
function removerItem(id) {
  fetch("remover_item.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id })
  })
  .then(r => r.json())
  .then(dados => {
    toast(dados.mensagem);
    listarItens();
  })
  .catch(() => toast("Erro ao remover.", "error"));
}

// Carrega a lista ao abrir
listarItens();