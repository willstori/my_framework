# My Framework

Este é um projeto de minha autoria criado com objetivo de estudar como são implementados alguns frameworks **Php**. Ele foi desenvolvido baseado nos frameworks **Codeigniter** em sua versão 3 e no  **Laravel**. 

Atualmente ele não deve ser utilizado em produção, pois alguns recursos importantes de segurança ainda não foram implementados. Porém ele apresenta alguns recursos que podem ajudar no desenvolvimento de pequenas aplicações, sendo eles:

- QueryBuilder (Construtor de Consultas ao banco de dados);
- Classe Moldel padrão para realizar a comunicação com o banco de dados;
- Classe Controller para tratamento das requisições;
- Mecanismo para criação de rotas dinâmicas e utilização de url amigaveis;
- Criação de Views utilizando **Html5** e **Php**.

## Instalação

A instalação deste Micro framework é simples, basta que os arquivos sejam copiados para a pasta public do seu servidor **php 5.3 ou superior** e sejam preenchidas as configurações no arquivo **.env**.

O arquivo sql para execução do exemplo encontra-se na raiz do projeto com o nome **db.sql**.