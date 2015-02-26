/**
 * Brazilian Portuguese translation
 * @author Jairo Moreno <master.zion@gmail.com>
 * @version 2010-10-18
 */
(function ($) {
    if (elFinder && elFinder.prototype.options && elFinder.prototype.options.i18n)
        elFinder.prototype.options.i18n.pt_BR = {
            /* errors */
            'Root directory does not exists': 'Diretório raiz não existe',
            'Unable to connect to backend': 'Não foi possivel conetar ao servidor',
            'Access denied': 'Acceso negado',
            'Invalid backend configuration': 'Erro de configuração no servidor',
            'Unknown command': 'Comando desconhecido',
            'Command not allowed': 'Comando não permitido',
            'Invalid parameters': 'Parâmetros inválidos',
            'File not found': 'Arquivo não encontrado',
            'Invalid name': 'Nome incorreto',
            'File or folder with the same name already exists': 'Já existe uma pasta com esse nome',
            'Unable to rename file': 'Não foi possível renomear o arquivo',
            'Unable to create folder': 'Não foi possível crar a pasta',
            'Unable to create file': 'Não foi possível criar o arquivo',
            'No file to upload': 'Não existe arquivos para serem enviados',
            'Select at least one file to upload': 'Selecione pelo pelo menos uma arquivo',
            'File exceeds the maximum allowed filesize': 'Tamanho máximo excedido',
            'Data exceeds the maximum allowed size': 'Dados excedem o tamanho máximo permitido',
            'Not allowed file type': 'Tipo de arquivo inválido',
            'Unable to upload file': 'Não foi possível enviar o arquivo',
            'Unable to upload files': 'Não foi possível enviar os arquivos',
            'Unable to remove file': 'Não foi possível remover o arquivo',
            'Unable to save uploaded file': 'Não foi possível salvar o arquivo enviado',
            'Some files was not uploaded': 'Alguns arquivos não foram enviados',
            'Unable to copy into itself': 'Não pode ser copiado para ele ele mesmo',
            'Unable to move files': 'Não foi possível mover os arquivos',
            'Unable to copy files': 'Não foi possível copiar os arquivos',
            'Unable to create file copy': 'Não foi possível criar a cópia do arquivo',
            'File is not an image': 'Aquivo não é uma imagem',
            'Unable to resize image': 'Não foi possível redimensionar a imagem',
            'Unable to write to file': 'Não foi possível gravar o arquivo',
            'Unable to create archive': 'Não foi criar gravar o arquivo',
            'Unable to extract files from archive': 'Não foi possível descompactar o arquivo',
            'Unable to open broken link': 'Não foi possível abrir. Link quebrado',
            'File URL disabled by connector config': 'URL desativada pela configuração do conector',
            /* statusbar */
            'items': 'objetos',
            'selected items': 'objetos selecionados',
            /* commands/buttons */
            'Back': 'Voltar',
            'Reload': 'Atualizar',
            'Open': 'Abrir',
            'Preview with Quick Look': 'Vizualização rápida',
            'Select file': 'Selecionar arquivo',
            'New folder': 'Nova pasta',
            'New text file': 'Novo arquivo texto',
            'Upload files': 'Enviar arquivos',
            'Copy': 'Copiar',
            'Cut': 'Cortar',
            'Paste': 'Colar',
            'Duplicate': 'Duplicar',
            'Remove': 'Remover',
            'Rename': 'Renomear',
            'Edit text file': 'Editar arquivo',
            'View as icons': 'Icones',
            'View as list': 'Lista',
            'Resize image': 'Tamanho da imagem',
            'Create archive': 'Novo arquivo',
            'Uncompress archive': 'Extrair arquivo',
            'Get info': 'Propiedades',
            'Help': 'Ajuda',
            'Dock/undock filemanger window': 'Prender/Soltar o gerenciador de arquivos da página',
            /* upload/get info dialogs */
            'Maximum allowed files size': 'Tamanho máximo do arquivo',
            'Add field': 'Adicionar campo',
            'File info': 'Propiedades do arquivo',
            'Folder info': 'Propiedades da pasta',
            'Name': 'Nome',
            'Kind': 'Tipo',
            'Size': 'Tamanho',
            'Modified': 'Modificado',
            'Permissions': 'Acesso',
            'Link to': 'Link para',
            'Dimensions': 'Dimensões',
            'Confirmation required': 'Confirmação requerida',
            'Are you sure you want to remove files?<br /> This cannot be undone!': 'Deseja remover o arquivo permanentemente?',
            /* permissions */
            'read': 'leitura',
            'write': 'escrita',
            'remove': 'remover',
            /* dates */
            'Jan': 'Jan',
            'Feb': 'Fev',
            'Mar': 'Mar',
            'Apr': 'Abr',
            'May': 'Mai',
            'Jun': 'Jun',
            'Jul': 'Jul',
            'Aug': 'Ago',
            'Sep': 'Set',
            'Oct': 'Out',
            'Nov': 'Nov',
            'Dec': 'Dec',
            'Today': 'Hoje',
            'Yesterday': 'Ontem',
            /* mimetypes */
            'Unknown': 'Desconhecido',
            'Folder': 'Pasta',
            'Alias': 'Apelido',
            'Broken alias': 'Apelido quebrado',
            'Plain text': 'Texto',
            'Postscript document': 'Documento postscript',
            'Application': 'Aplicação',
            'Microsoft Office document': 'Documento Microsoft Office',
            'Microsoft Word document': 'Documento Microsoft Word',
            'Microsoft Excel document': 'Documento Microsoft Excel',
            'Microsoft Powerpoint presentation': 'Documento Microsoft Powerpoint',
            'Open Office document': 'Documento Open Office',
            'Flash application': 'Aplicación Flash',
            'XML document': 'Documento XML',
            'Bittorrent file': 'arquivo bittorrent',
            '7z archive': 'arquivo 7z',
            'TAR archive': 'arquivo TAR',
            'GZIP archive': 'arquivo GZIP',
            'BZIP archive': 'arquivo BZIP',
            'ZIP archive': 'arquivo ZIP',
            'RAR archive': 'arquivo RAR',
            'Javascript application': 'Aplicação Javascript',
            'PHP source': 'Documento PHP',
            'HTML document': 'Documento HTML',
            'Javascript source': 'Documento Javascript',
            'CSS style sheet': 'Documento CSS',
            'C source': 'Documento C',
            'C++ source': 'Documento C++',
            'Unix shell script': 'Script Unix shell',
            'Python source': 'Documento Python',
            'Java source': 'Documento Java',
            'Ruby source': 'Documento Ruby',
            'Perl script': 'Script Perl',
            'BMP image': 'Imagem BMP',
            'JPEG image': 'Imagem JPEG',
            'GIF Image': 'Imagem GIF',
            'PNG Image': 'Imagem PNG',
            'TIFF image': 'Imagem TIFF',
            'TGA image': 'Imagem TGA',
            'Adobe Photoshop image': 'Imagem Adobe Photoshop',
            'MPEG audio': 'Audio MPEG',
            'MIDI audio': 'Audio MIDI',
            'Ogg Vorbis audio': 'Audio Ogg Vorbis',
            'MP4 audio': 'Audio MP4',
            'WAV audio': 'Audio WAV',
            'DV video': 'Video DV',
            'MP4 video': 'Video MP4',
            'MPEG video': 'Video MPEG',
            'AVI video': 'Video AVI',
            'Quicktime video': 'Video Quicktime',
            'WM video': 'Video WM',
            'Flash video': 'Video Flash',
            'Matroska video': 'Video Matroska',
            // 'Shortcuts' : 'Клавиши',		
            'Select all files': 'Selecionar todos arquivos',
            'Copy/Cut/Paste files': 'Copiar/Cortar/colar arquivos',
            'Open selected file/folder': 'Abrir pasta/arquivo',
            'Open/close QuickLook window': 'Abrir/Fechar a visualização rápida',
            'Remove selected files': 'Remover arquivos selecionados',
            'Selected files or current directory info': 'Informações dos arquivos ou pastas selecionadas',
            'Create new directory': 'Nova pasta',
            'Open upload files form': 'Abrir janela para enviar arquivos',
            'Select previous file': 'Selecionar arquivo anterior',
            'Select next file': 'Selecionar próximo arquivo',
            'Return into previous folder': 'Retornar à pasta anterior',
            'Increase/decrease files selection': 'Aumentar/diminuir a seleção de arquivos',
            'Authors': 'Autores',
            'Sponsors': 'Colaboradores',
            'elFinder: Web file manager': 'elFinder: Gerenciador de arquivos para web',
            'Version': 'Versão',
            'Copyright: Studio 42 LTD': 'Copyright: Studio 42',
            'Donate to support project development': 'Ajude o desenvolvimento do projeto',
            'Javascripts/PHP programming: Dmitry (dio) Levashov, dio@std42.ru': 'Programação Javascripts/php: Dmitry (dio) Levashov, dio@std42.ru',
            'Python programming, techsupport: Troex Nevelin, troex@fury.scancode.ru': 'Programação Python, suporte técnico: Troex Nevelin, troex@fury.scancode.ru',
            'Design: Valentin Razumnih': 'Diseño: Valentin Razumnyh',
            'Spanish localization': 'Tradução em español',
            'Brazilian Portuguese localization': 'Tradução em português',
            'Icons': 'Icones',
            'License: BSD License': 'Licencia: BSD License',
            'elFinder documentation': 'Documentação elFinder',
            'Simple and usefull Content Management System': 'Gerenciados de arquivos simples e prático',
            'Support project development and we will place here info about you': 'Ajude o desenvolvimento do produto e informações sobre voc~e aparecerão aqui.',
            'Contacts us if you need help integrating elFinder in you products': 'Contacte-nos se quiser integrar elFinder em seus produtos.',
            'elFinder support following shortcuts': 'elFinder suporta as seguintes teclas de atalho',
            'helpText': 'elFinder funciona como um gerenciador de arquivos do PC<br />Pode-se manipular os arquivos com auda do painel superior, menu ou com teclas de atalho. Para mover arquivo/pastas simplemente arraste-os para pasta deseada.	Ao  presionar a tecla Shift os arquivos se copiarão automáticamente.'
        };
})(jQuery);
