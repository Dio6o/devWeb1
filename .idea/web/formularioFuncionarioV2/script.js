const form = document.getElementById("formFuncionario");
const tabelaContainer = document.getElementById("tabelaContainer");

const funcionarios = [];

form.addEventListener("submit", function (e) {
    e.preventDefault();

    const salarioBase = parseFloat(document.getElementById("salario").value) || 0;
    const filhos = Math.min(parseInt(document.getElementById("filhos").value) || 0, 3);

    const valeAlimentacao = salarioBase * 0.10;
    const salarioFamilia = 100 * filhos;
    const inss = salarioBase * 0.20;
    const salarioTotal = salarioBase + valeAlimentacao + salarioFamilia - inss;

    const funcionario = {
        Nome: document.getElementById("nome").value,
        Nascimento: document.getElementById("dataNascimento").value,
        Sexo: document.getElementById("sexo").value,
        CPF: document.getElementById("cpf").value,
        RG: document.getElementById("rg").value,
        Titulo: document.getElementById("titulo").value,
        Rua: document.getElementById("rua").value,
        Numero: document.getElementById("numero").value,
        Bairro: document.getElementById("bairro").value,
        Cidade: document.getElementById("cidade").value,
        Estado: document.getElementById("estado").value,
        CEP: document.getElementById("cep").value,
        Telefone: document.getElementById("telefone").value,
        Celular: document.getElementById("celular").value,
        Filhos: filhos,
        SalarioBase: salarioBase,
        ValeAlimentacao: valeAlimentacao,
        SalarioFamilia: salarioFamilia,
        INSS: inss,
        SalarioTotal: salarioTotal,
        Descontos: inss
    };

    funcionarios.push(funcionario);
    renderTable();
    form.reset();
});

function renderTable() {
    let maiorSalario = funcionarios[0].SalarioBase;
    let menorSalario = funcionarios[0].SalarioBase;

    for (var i = 0; i < funcionarios.length; i++) {
        if (funcionarios[i].SalarioBase > maiorSalario) {
            maiorSalario = funcionarios[i].SalarioBase;
        }
        if (funcionarios[i].SalarioBase < menorSalario) {
            menorSalario = funcionarios[i].SalarioBase;
        }
    }

    var tabela = "<table class='table table-bordered mt-3'>";
    tabela += "<thead class='table-dark'><tr>";
    tabela += "<th>Nome</th><th>Nascimento</th><th>Sexo</th><th>CPF</th><th>RG</th><th>Titulo</th>";
    tabela += "<th>Rua</th><th>Numero</th><th>Bairro</th><th>Cidade</th><th>Estado</th><th>CEP</th>";
    tabela += "<th>Telefone</th><th>Celular</th><th>Filhos</th>";
    tabela += "<th>Salario Base</th><th>Vale Alimentacao</th><th>Salario Familia</th><th>INSS</th><th>Salario Total</th><th>Descontos</th>";
    tabela += "</tr></thead><tbody>";

    for (var i = 0; i < funcionarios.length; i++) {
        var f = funcionarios[i];
        var cor = "";

        if (funcionarios.length > 1) {
            if (f.SalarioBase === maiorSalario) cor = "background-color: #ffcccc;";
            if (f.SalarioBase === menorSalario) cor = "background-color: #ffffcc;";
        }

        tabela += "<tr style='" + cor + "'>";
        tabela += "<td>" + f.Nome + "</td>";
        tabela += "<td>" + f.Nascimento + "</td>";
        tabela += "<td>" + f.Sexo + "</td>";
        tabela += "<td>" + f.CPF + "</td>";
        tabela += "<td>" + f.RG + "</td>";
        tabela += "<td>" + f.Titulo + "</td>";
        tabela += "<td>" + f.Rua + "</td>";
        tabela += "<td>" + f.Numero + "</td>";
        tabela += "<td>" + f.Bairro + "</td>";
        tabela += "<td>" + f.Cidade + "</td>";
        tabela += "<td>" + f.Estado + "</td>";
        tabela += "<td>" + f.CEP + "</td>";
        tabela += "<td>" + f.Telefone + "</td>";
        tabela += "<td>" + f.Celular + "</td>";
        tabela += "<td>" + f.Filhos + "</td>";
        tabela += "<td>" + f.SalarioBase.toFixed(2) + "</td>";
        tabela += "<td>" + f.ValeAlimentacao.toFixed(2) + "</td>";
        tabela += "<td>" + f.SalarioFamilia.toFixed(2) + "</td>";
        tabela += "<td>" + f.INSS.toFixed(2) + "</td>";
        tabela += "<td>" + f.SalarioTotal.toFixed(2) + "</td>";
        tabela += "<td>" + f.Descontos.toFixed(2) + "</td>";
        tabela += "</tr>";
    }

    tabela += "</tbody></table>";
    tabelaContainer.innerHTML = "<h4>Funcionários Cadastrados</h4><div style='overflow-x:auto'>" + tabela + "</div>";
}