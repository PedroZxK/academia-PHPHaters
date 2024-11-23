Pré-requisitos
Antes de começar a instalação do Composer, você precisa ter o PHP instalado no seu sistema. O Composer requer o PHP 7.2.5 ou superior. Você pode verificar se o PHP está instalado em sua máquina com o seguinte comando:

bash
Copiar código
php -v
Se o PHP não estiver instalado, você pode baixar e instalar a versão mais recente do PHP aqui.

Instalação do Composer
Passo 1: Baixar o Instalador
Acesse o site oficial do Composer https://getcomposer.org/download/.
Você verá diferentes opções de instalação dependendo do seu sistema operacional. Para sistemas Unix (Linux/Mac), o Composer pode ser instalado diretamente via terminal. Para Windows, será necessário o instalador gráfico.
Para sistemas Unix (Linux/Mac):
Abra o terminal e execute o comando abaixo para baixar o instalador do Composer:

bash
Copiar código
curl -sS https://getcomposer.org/installer | php
Isso irá baixar o composer.phar (o arquivo executável do Composer) para o diretório atual.

Para Windows:
Baixe o instalador do Composer clicando aqui.
Execute o instalador e siga os passos na interface gráfica.
Passo 2: Mover o Composer para o Diretório Global (Opcional)
Para sistemas Unix (Linux/Mac):
Se você deseja usar o Composer de qualquer lugar no seu sistema, mova o arquivo composer.phar para o diretório /usr/local/bin:

bash
Copiar código
sudo mv composer.phar /usr/local/bin/composer
Agora, você pode executar o Composer globalmente com o comando:

bash
Copiar código
composer
Para Windows:
Se você usou o instalador gráfico, o Composer será configurado automaticamente para ser executado de qualquer lugar através do comando composer no terminal.

Passo 3: Verificar a Instalação
Após a instalação, você pode verificar se o Composer foi instalado corretamente com o seguinte comando no terminal:

bash
Copiar código
composer --version
Esse comando deve retornar a versão do Composer instalada, indicando que a instalação foi bem-sucedida.