# Projeto de Gestão de Acervo Bibliotecário

Este é um sistema completo para gerenciamento de acervos bibliotecários e controle de fluxo de estoque de livros. O projeto é dividido de forma clara entre uma API Backend desenvolvida em **PHP** sob a arquitetura clássica **MVC (Model-View-Controller)** e uma interface Frontend web dinâmica e estilizada.

---

## 🚀 Funcionalidades Principais

* **Gestão de Usuários:** Cadastro, autenticação e controle de acessos ao sistema.
* **Gestão de Acervo:** Cadastro, edição, remoção e listagem em tempo real de obras literárias.
* **Controle de Estoque Avançado:** Camada dedicada exclusivamente para gerenciar a entrada, saída e movimentação física de exemplares do acervo.
* **API RESTful:** Endpoints padronizados em PHP para fornecer respostas estruturadas à interface do usuário de forma assíncrona.

---

## 📂 Estrutura de Diretórios

Abaixo está o mapeamento completo e atualizado da árvore de arquivos do projeto com base na imagem `image_378c3a.png`:

```text
ProjetoGestaoAcervoBibliotecario/
│
├── api_livros/                  # Backend da Aplicação (API PHP)
│   ├── app/
│   │   ├── controller/          # Controladores (Regras de negócio e rotas da API)
│   │   │   ├── EstoqueController.php   # NOVO: Controle de fluxos de estoque
│   │   │   ├── LivroController.php
│   │   │   └── UsuarioController.php
│   │   ├── model/               # Modelos (Comunicação com o Banco de Dados)
│   │   │   ├── EstoqueModel.php
│   │   │   ├── LivroModel.php
│   │   │   └── UsuarioModel.php
│   │   └── view/                # Views (Formatadores de respostas de saída da API)
│   │       ├── EstoqueView.php         # NOVO: Estruturação de dados do estoque
│   │       ├── LivroView.php
│   │       └── UsuarioView.php
│   ├── config/                  # Arquivos de configuração global
│   │   ├── db.php               # Conexão oficial com o Banco de Dados
│   │   ├── testedb.php          # Script de testes de conexão 1
│   │   └── testedb2.php         # Script de testes de conexão 2
│   ├── public/                  # Diretório público de entrada
│   │   └── index.php            # Arquivo index / Router principal da API
│   └── .htaccess                # Reescrita de URLs para o servidor Apache
│
├── BD/                          # Camada de Persistência
│   └── script-bd.sql            # Script SQL de criação de tabelas e cargas iniciais
│
└── front_livros/                # Interface do Usuário (Frontend)
    ├── assets/                  # Arquivos de recursos estáticos
    │   └── css/
    │       └── style.css        # NOVO: Folha de estilos unificada do sistema
    ├── cadastro.html            # Tela de cadastro de livros e usuários
    ├── editar.html              # Tela de edição de registros
    ├── index.html               # Tela de login / Portal de entrada
    ├── listaLivros.html         # Painel de busca e visualização do acervo
    ├── movimentarEstoque.html   # Tela de gerenciamento de entrada/saída de livros
    └── principal.html           # Painel de controle / Menu principal do sistema