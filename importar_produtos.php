<?php
include("conexao.php");

$produtos = [
    ["nome" => "ARROZ", "valor" => 34.90],
    ["nome" => "FEIJAO", "valor" => 8.20],
    ["nome" => "FEIJAO PRETO", "valor" => 8.20],
    ["nome" => "CAFÉ", "valor" => 37.90],
    ["nome" => "OLEO", "valor" => 8.70],
    ["nome" => "ARISCO PQ", "valor" => 5.80],
    ["nome" => "AZEITE MISTURADO C/ OLEO", "valor" => 15.90],
    ["nome" => "AZEITE", "valor" => 55.90],
    ["nome" => "FARINHA DE MANDIOCA BRANCA", "valor" => 5.20],
    ["nome" => "FUBÁ", "valor" => 3.70],
    ["nome" => "MACARRÃO", "valor" => 4.60],
    ["nome" => "MIOJO", "valor" => 2.95],
    ["nome" => "SAL", "valor" => 3.80],
    ["nome" => "LEITE INTEGRAL", "valor" => 5.90],
    ["nome" => "LEITE DESNATADO", "valor" => 5.90],
    ["nome" => "FILTRO MELITTA", "valor" => 4.80],
    ["nome" => "PIPOCA DOCE", "valor" => 2.00],
    ["nome" => "SALGADINHO", "valor" => 2.80],
    ["nome" => "BATATA PALHA", "valor" => 8.30],
    ["nome" => "LEITE CONDENSADO", "valor" => 6.95],
    ["nome" => "CREME DE LEITE", "valor" => 3.90],
    ["nome" => "MAIONESE", "valor" => 11.90],
    ["nome" => "MAIONESA LANCHE", "valor" => 11.90],
    ["nome" => "ADOÇANTE GR", "valor" => 11.90],
    ["nome" => "MOLHO", "valor" => 2.20],
    ["nome" => "EXTRATO DE TOMATE", "valor" => 7.50],
    ["nome" => "SUCO CAJU", "valor" => 9.90],
    ["nome" => "CREAM CRACKER", "valor" => 3.90],
    ["nome" => "DOCE", "valor" => 3.50],
    ["nome" => "TAPIOCA", "valor" => 5.00],
    ["nome" => "GOIBINHA", "valor" => 4.95],
    ["nome" => "GELATINA DIET", "valor" => 2.30],
    ["nome" => "LATA FEIJOADA", "valor" => 20.90],
    ["nome" => "GUARANÁ ZERO", "valor" => 9.50],
    ["nome" => "COCA", "valor" => 6.50],
    ["nome" => "COCA 200ml", "valor" => 2.20],
    ["nome" => "SCHWEPPES", "valor" => 3.99],
    ["nome" => "CERVEJA", "valor" => 57.50],
    ["nome" => "CIGARRO", "valor" => 122.50],
    ["nome" => "CEBOLA", "valor" => 5.50],
    ["nome" => "BATATA", "valor" => 3.90],
    ["nome" => "ALHO", "valor" => 49.90],
    ["nome" => "PÃO DE FORMA", "valor" => 8.70],
    ["nome" => "BATATA DOCE", "valor" => 4.99],
    ["nome" => "COUVE PICADA", "valor" => 30.00],
    ["nome" => "CHEIRO VERDE", "valor" => 5.00],
    ["nome" => "TOMATE", "valor" => 9.99],
    ["nome" => "CENOURA", "valor" => 6.90],
    ["nome" => "MANGA", "valor" => 5.90],
    ["nome" => "MAMÃO", "valor" => 6.50],
    ["nome" => "MANDIOCA", "valor" => 6.50],
    ["nome" => "LIMÃO", "valor" => 6.99],
    ["nome" => "ALFACE", "valor" => 3.50],
    ["nome" => "PEPINO", "valor" => 9.99],
    ["nome" => "MARGARINA", "valor" => 9.70],
    ["nome" => "QUEIJO RALADO PARMESÃO", "valor" => 6.00],
    ["nome" => "BATATINHA", "valor" => 28.90],
    ["nome" => "MANTEIGA", "valor" => 12.90],
    ["nome" => "PEITO DE FRANGO SEM OSSO", "valor" => 22.90],
    ["nome" => "CARNE MOIDA MUSCULO", "valor" => 35.90],
    ["nome" => "LINGUIÇA CALABRESA", "valor" => 26.90],
    ["nome" => "COXA E SOBRECOXA", "valor" => 13.50],
    ["nome" => "COXINHA DA ASA", "valor" => 16.50],
    ["nome" => "BARRIGA", "valor" => 29.90],
    ["nome" => "SALSICHA", "valor" => 15.90],
    ["nome" => "CONTRA FILE", "valor" => 59.90],
    ["nome" => "BISTECA DE PORCO", "valor" => 23.90],
    ["nome" => "NUGGETS", "valor" => 12.70],
    ["nome" => "PRESUNTO", "valor" => 38.90],
    ["nome" => "MUSSARELA", "valor" => 52.90],
    ["nome" => "SALAMINHO", "valor" => 13.00],
    ["nome" => "HAMBURGER", "valor" => 5.00],
    ["nome" => "ACEM", "valor" => 35.90],
    ["nome" => "CLORÍFICO", "valor" => 2.10],
    ["nome" => "COMINHO EM PÓ", "valor" => 2.10],
    ["nome" => "BICARBONATO GR", "valor" => 14.90],
    ["nome" => "CALDO KNORR CARNE", "valor" => 5.00],
    ["nome" => "SABAO EM PO", "valor" => 29.90],
    ["nome" => "AMACIANTE DE ROUPA 2 LITROS", "valor" => 10.90],
    ["nome" => "SABÃO EM PEDRA", "valor" => 4.20],
    ["nome" => "PAPEL HIGIENICO", "valor" => 19.50],
    ["nome" => "SACO DE LIXO 30L", "valor" => 6.00],
    ["nome" => "SACO DE LIXO 100L", "valor" => 10.50],
    ["nome" => "SABONETE", "valor" => 4.20],
    ["nome" => "PAPEL TOALHA", "valor" => 5.20],
    ["nome" => "DETERGENTE", "valor" => 2.70],
    ["nome" => "ESPONJA", "valor" => 7.00],
    ["nome" => "PANO MULTIUSO", "valor" => 9.90],
    ["nome" => "SABÃO NENE", "valor" => 13.90],
    ["nome" => "AMACIANTE NENE", "valor" => 8.00],
    ["nome" => "SACO PLÁSTICO 3L", "valor" => 7.50],
    ["nome" => "SACO PLÁSTICO 2L", "valor" => 5.60],
    ["nome" => "SACO PLÁSTICO 5L", "valor" => 7.90],
];

$stmt = $conexao->prepare("INSERT INTO produtos (nome, valor) VALUES (?, ?)");

$importados  = 0;
$ignorados   = 0;
$erros       = [];

foreach ($produtos as $produto) {

    // Verifica se o produto já existe no banco
    $check = $conexao->prepare("SELECT id FROM produtos WHERE nome = ?");
    $check->bind_param("s", $produto["nome"]);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $ignorados++;
        continue;
    }

    $stmt->bind_param("sd", $produto["nome"], $produto["valor"]);

    if ($stmt->execute()) {
        $importados++;
    } else {
        $erros[] = $produto["nome"];
    }

}

echo json_encode([
    "mensagem"   => "Importação concluída!",
    "importados" => $importados,
    "ignorados"  => $ignorados,
    "erros"      => $erros
]);
