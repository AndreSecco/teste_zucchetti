# Teste Zucchetti

Siga o passo a passo abaixo para instalar e rodar a aplicação.

Primeiro é necessário realizar o clone deste projeto em uma pasta em seu computador.

### 🔧 Instalação

#### FronEnd

Após realizar o clone deste projeto, realize os comando s a seguir:

```
cd teste_zucchetti
cd frontend
npm install
```

Logo depois de ser instalado todas as depenências do VueJs, execute o comando:

```
npm run serve
```

Isto irá executar o frontend em sua máquina local

Como a conexão do fronend com o backend vai depender da sua arvore de arquivos, entre no arquivo:

```
frontend/src/common/api.js
```

Na função 'getApiUrl()', verifiquei se o caminho para a pasta backend está direcionada corretamente onde os seus arquivos estão.

#### BackEnd

Como neste arquivo possui todas as dependências necessárias para o sistema funcionar, você apenas precisará importar e configurar o banco de dados:

Importe o arquivo presente 'bd.sql' em seu phpMyAdmin para importar o banco de dados, e então entre no arquivo:

```
'./app/DB/Database.php' 
```

e na função 'setConfigBD()', configure as informações do seu banco local para o funcionamento do projeto.


## 🚀 Começando

Ao finalizar estes passos você poderá acessar a aplicação VueJS através do seu navegador.
