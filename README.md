# Sistema de Gerenciamento de Estacionamento - Alucomaxx

Este é um projeto de **Sistema de Gerenciamento de Estacionamento** desenvolvido para registrar e monitorar a entrada e saída de veículos em tempo real utilizando reconhecimento de placas (ANPR) com câmeras de segurança.

O sistema foi projetado para ser utilizado em uma empresa para otimizar o controle de veículos no estacionamento, registrando automaticamente as informações de entrada e saída, e permitindo o acesso a dados por meio de uma interface web.

## Funcionalidades

- **Registro de Entrada**: Captura automaticamente a hora e a placa do veículo ao entrar no estacionamento.
- **Registro de Saída**: Registra a hora de saída do veículo, calculando o tempo de permanência.
- **Interface Web**: Interface intuitiva para registrar entradas e saídas de veículos.
- **Visualização de Registros**: Visualize o histórico de entradas e saídas no sistema.
- **Suporte a Câmeras**: Integração com câmeras IP para capturar imagens e realizar o reconhecimento de placas (ANPR).

## Tecnologias Utilizadas

- **PHP**: Backend para manipulação dos dados e interação com o banco de dados.
- **MySQL**: Banco de dados para armazenar informações sobre entradas, saídas e placas dos veículos.
- **HTML/CSS/JavaScript**: Frontend para a interface de usuário.
- **OpenCV/Tesseract (Opcional)**: Bibliotecas de reconhecimento de placas para integração com câmeras IP.

## Pré-Requisitos

- **Servidor Web** (exemplo: XAMPP, WAMP, ou Apache).
- **PHP 7.4 ou superior**.
- **Banco de Dados MySQL**.
- **Câmeras IP** com suporte a protocolos como **RTSP** ou **ONVIF** para captura de imagens de placas de veículos (opcional, caso você queira integrar com câmeras).
- **Bibliotecas de ANPR (OCR)** como **Tesseract** ou soluções dedicadas para reconhecimento de placas.



