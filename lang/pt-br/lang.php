<?php

return [
    'plugin' => [
        'name' => 'Contatos',
        'description' => 'Plugin to manage Contatos.'
    ],

    'base' => [
        'contact' => 'Contato',
        'contacts' => 'Contatos',
        'form' => 'Formulário',
        'forms' => 'Formulários',
        'newsletter' => 'Newsletter',
        'settings' => 'Configurações',
    ],

    'contacts' => [
        'id' => 'ID',
        'form' => 'Formulário',
        'email' => 'E-mail',
        'status' => 'Status',
        'markasreed' => 'Marcar como lido',
        'message' => 'Mensagem',
        'files' => 'Arquivos',
        'created_at' => 'Enviado em',
        'updated_at' => 'Atualizado em',

        'delete_selected' => 'Excluir selecionados',
        'delete_confirm' => 'Tem certeza que deseja excluir os contatos selecionados?',
        'export' => 'Exportar',
        'export_records' => 'Exportar registros',
        'list_title' => 'Gerenciar Contatos',
        'return' => 'Voltar para lista de contatos',
        'delete_confirm' => 'Excluir este contato?',
        'create' => 'Create Contato',
        'update' => 'Editar Contato',
        'preview' => 'Visualizar Contato',
    ],

    'form' => [
        'id' => 'ID',
        'name' => 'Nome',
        'code' => 'Código',
        'emails' => 'E-mails',
        'created_at' => 'Criado em',
        'updated_at' => 'Atualizado em',
        'fields' => 'Campos',
        'fields_label' => 'Label',
        'fields_name' => 'Name',
        'fields_type' => 'Type',
        'fields_options_label' => 'Label',
        'fields_options_value' => 'Value',
        'fields_placeholder' => 'Placeholder',
        'fields_partial' => 'Partial',
        'fields_validation' => 'Validação',
        'fields_validation_rule' => 'Regra',
        'fields_validation_message' => 'Mensagem',
        'fields_validation_message_default' => 'Este campo é obrigatório',
        'fields_columns' => 'Colunas CSS',
        'redirect' => 'Redirecionar',
        'redirect_to' => 'Redirecionar para',
        'success_message' => 'Mensagem de sucesso',
        'success_message_default' => '<p>Mensagem enviada com sucesso!</p>',
        'error_message' => 'Mensagem de erro',
        'error_message_default' => '<p>Algo deu errado!</p>',
        'geral_tab' => 'Geral',
        'message_tab' => 'Mensagens',

        'delete_selected' => 'Excluir selecionados',
        'delete_confirm' => 'Tem certeza que deseja excluir os formulário selecionados?',
        'list_title' => 'Gerenciar Formulários',
        'return' => 'Voltar para lista de formulários',
        'delete_confirm' => 'Excluir este formulário?',
        'new' => 'Novo Formulário',
        'create' => 'Criar Formulário',
        'update' => 'Editar Formulário',
        'preview' => 'Visualizar Formulário',
    ],

    'newsletter' => [
        'id' => 'ID',
        'name' => 'Name',
        'email' => 'E-mail',
        'created_at' => 'Enviado em',
        'updated_at' => 'Atualizado em',

        'delete_selected' => 'Excluir selecionados',
        'delete_confirm' => 'Tem certeza que deseja excluir os newsletter selecionados?',
        'export' => 'Exportar',
        'export_records' => 'Exportar registros',
        'list_title' => 'Gerenciar Newsletter',
        'return' => 'Voltar para lista de newsletter',
        'delete_confirm' => 'Excluir este newsletter?',
        'create' => 'Criar Newsletter',
        'update' => 'Editar Newsletter',
        'preview' => 'Visualizar Newsletter',
    ],

    'settings' => [
        'label'       => 'Contato',
        'description' => 'Contato Configurações',
        'category'    => 'Contato',
    ],

    'validation' => [
        'required' => 'Este compo é obrigatório',
        'email' => 'Informe um e-mail válido',
    ],

    'widget' =>  [
        'messages' => 'Mensagens',
        'unread' => 'Não Lidas',
        'see_all' => 'Ver Todas'
    ]
];