const idades = [22, 45, 12, 33, 28, 67, 19, 54, 38, 5];

console.log("Lista não ordenada:");
idades.forEach(i => console.log(i));

console.log("\nOrdem crescente:");
[...idades].sort((a, b) => a - b).forEach(i => console.log(i));

console.log("\nOrdem decrescente:");
[...idades].sort((a, b) => b - a).forEach(i => console.log(i));

const fila = [
  { id: 1, nome: "Ana Lima",     salario: 3200, idade: 28 },
  { id: 2, nome: "Carlos Souza", salario: 5800, idade: 42 },
  { id: 3, nome: "Julia Melo",   salario: 4100, idade: 23 },
  { id: 4, nome: "Pedro Alves",  salario: 7500, idade: 35 },
  { id: 5, nome: "Beatriz Costa",salario: 2900, idade: 19 },
];

console.log("\nTabela de funcionários:");
console.table(fila);

const maisNovo   = fila.reduce((m, f) => f.idade   < m.idade   ? f : m);
const maiorSal   = fila.reduce((m, f) => f.salario > m.salario ? f : m);

console.log("\nFuncionário mais novo:", maisNovo.nome);
console.log("Idade do maior salário:", maiorSal.idade, "anos (" + maiorSal.nome + ")");
