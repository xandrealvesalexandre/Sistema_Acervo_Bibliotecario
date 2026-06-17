# Projeto de Gestão de Acervo Bibliotecário (PGAB)

Este é um sistema robusto para o gerenciamento de acervos bibliotecários e controle rigoroso de estoque de livros. O projeto é estruturado dividindo de forma clara as responsabilidades entre uma API Backend desenvolvida em **PHP** sob a arquitetura **MVC** e uma interface Frontend independente baseada em páginas web.

---

## 🚀 Funcionalidades Principais

* **Gestão de Usuários:** Cadastro, controle de acessos e autenticação no sistema.
* **Gestão do Acervo:** Cadastro, edição, remoção e listagem detalhada de obras literárias.
* **Controle de Estoque:** Módulo dedicado à movimentação (entradas e saídas) de exemplares físicos do acervo.
* **API RESTful:** Endpoints em PHP que centralizam as regras de negócio e fornecem respostas estruturadas para o frontend.

---

## 📂 Estrutura de Diretórios

Abaixo está o mapeamento completo da estrutura de pastas atualizada do projeto:

```text
PGABV4_CORRIGIDO/
└── pgabv4/
    └── ProjetoGestaoAcervoBibliotecario/
        ├── api_livros/                  # Backend da Aplicação (API PHP)
        │   ├── app/
        │   │   ├── controller/          # Controladores (Regras de negócio e rotas)
        │   │   │   ├── LivroController.php
        │   │   │   └── UsuarioController.php
        │   │   ├── model/               # Modelos (Comunicação com a Base de Dados)
        │   │   │   ├── EstoqueModel.php     # Novo: Regras de movimentação de estoque
        │   │   │   ├── LivroModel.php
        │   │   │   └── UsuarioModel.php
        │   │   └── view/                # Formatação das respostas de saída da API
        │   │       ├── LivroView.php
        │   │       └── UsuarioView.php
        │   ├── config/                  # Arquivos de configuração do sistema
        │   │   ├── db.php               # Conexão principal com o Banco de Dados
        │   │   ├── testedb.php          # Script de validação de conexão 1
        │   │   └── testedb2.php         # Script de validação de conexão 2
        │   ├── public/                  # Diretório público / Entrada do servidor
        │   │   └── index.php            # Arquivo principal (Router)
        │   └── .htaccess                # Reescrita de URLs do servidor Apache
        │
        ├── BD/                          # Camada de Banco de Dados
        │   └── script-bd.sql            # Script SQL de criação de tabelas e sementes
        │
        └── front_livros/                # Interface do Usuário (Frontend)
            ├── cadastro.html            # Tela de cadastro de livros e usuários
            ├── editar.html              # Nova: Tela para edição de dados existentes
            ├── index.html               # Tela de Login / Portal de entrada
            ├── listaLivros.html         # Painel de visualização e busca do acervo
            ├── movimentarEstoque.html   # Gerenciamento de entradas/saídas do estoque
            └── principal.html           # Dashboard / Menu principal da aplicação