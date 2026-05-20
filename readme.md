# Projeto de Gestão de Acervo Bibliográfico

Este é um sistema completo para gerenciamento de acervo bibliográfico e controle de estoque de livros. O projeto é dividido de forma clara entre uma API backend desenvolvida em PHP (utilizando o padrão de arquitetura MVC) e uma interface frontend web construída com HTML estrutural.

---

## 🚀 Funcionalidades

* **Cadastro e Controle de Usuários:** Gerenciamento de acessos e perfis do sistema.
* **Gestão de Livros:** Cadastro, edição, remoção e listagem de obras literárias.
* **Movimentação de Estoque:** Controle de entrada e saída de exemplares no acervo.
* **API RESTful:** Endpoints estruturados em PHP para comunicação assíncrona com o frontend.

---

## 📂 Estrutura do Projeto

Abaixo está a representação da árvore de diretórios do sistema:

```text
PROJETOGESTAOACERVOBIBLIOTECA/
│
├── api_livros/                  # Backend da aplicação (API PHP)
│   ├── app/
│   │   ├── controller/          # Controladores (Regras de negócio e rotas)
│   │   │   ├── LivroController.php
│   │   │   └── UsuarioController.php
│   │   ├── model/               # Modelos (Comunicação com o Banco de Dados)
│   │   │   ├── LivroModel.php
│   │   │   └── UsuarioModel.php
│   │   └── view/                # Visualizações (Retornos da API/Telas específicas)
│   │       └── UsuarioView.php
│   ├── config/                  # Arquivos de configuração do sistema
│   │   ├── db.php               # Conexão oficial com o banco de dados
│   │   ├── testedb.php          # Script de teste de conexão 1
│   │   └── testedb2.php         # Script de teste de conexão 2
│   ├── public/                  # Direto público de entrada da API
│   │   └── index.php            # Arquivo principal / Router
│   └── .htaccess                # Configurações do servidor Apache (Reescrita de URL)
│
├── BD/                          # Scripts do Banco de Dados
│   └── script-bd.sql            # Estrutura das tabelas e dados iniciais
│
├── front_livros/                # Interface do Usuário (Frontend)
│   ├── cadastro.html            # Tela de cadastro de usuários/livros
│   ├── index.html               # Tela de login / Entrada principal
│   ├── listaLivros.html         # Painel de visualização do acervo
│   ├── movimentarEstoque.html   # Tela de entrada e saída de livros
│   └── principal.html           # Dashboard / Menu principal do sistema
│
├── teste.html                   # Arquivo temporário de testes frontend
└── readme.md                    # Documentação do projeto