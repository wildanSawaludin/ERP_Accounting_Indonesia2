/**
 * Dutch translation
 * @author Kurt Aerts
 * @version 2010-09-22
 */
(function ($) {
    if (elFinder && elFinder.prototype.options && elFinder.prototype.options.i18n)
        elFinder.prototype.options.i18n.nl = {
            /* errors */
            'Root directory does not exists': 'Root map bestaat niet',
            'Unable to connect to backend': 'Kon niet verbinden met backend',
            'Access denied': 'Geen toegang',
            'Invalid backend configuration': 'Foute backend configuratie',
            'Unknown command': 'Niet gekend commando',
            'Command not allowed': 'Commando niet toegestaan',
            'Invalid parameters': 'Foute parameters',
            'File not found': 'Bestand niet gevonden',
            'Invalid name': 'Foute naam',
            'File or folder with the same name already exists': 'Bestand of folder met deze naam bestaat al',
            'Unable to rename file': 'Niet mogegelijk om bestand te hernoemen',
            'Unable to create folder': 'Niet mogelijk om folder te maken',
            'Unable to create file': 'Niet mogelijk om bestand aan te maken',
            'No file to upload': 'Geen bestand om te uploaden',
            'Select at least one file to upload': 'Selecteer op zijn minst een bestand om te uploaden',
            'File exceeds the maximum allowed filesize': 'Bestand overschrijft de maximum toegekaten bestandsgrote',
            'Not allowed file type': 'Niet toegelaten bestandstype',
            'Unable to upload file': 'Niet mogelijk om bestand te uploaden',
            'Unable to upload files': 'Niet mogelijk om bestanden te uploaden',
            'Unable to remove file': 'Bestand verwijderen is onmogelijk',
            'Unable to save uploaded file': 'Geuploaden bestand kon niet bewaard worden',
            'Some files was not uploaded': 'Sommige bestanden zijn niet geupload',
            'Unable to copy into itself': 'Niet mogelijk om inzichg zelf te kopieeren',
            'Unable to move files': 'Niet mogelijk om bestanden te verplaatsen',
            'Unable to copy files': 'Niet mogelijk om bestanden te kopieeren',
            'Unable to create file copy': 'Niet mogelijk om kopie van bestand te maken',
            'File is not an image': 'Bestand is geen afbeelding',
            'Unable to resize image': 'Niet mogelijk afbeelding te schalen',
            'Unable to write to file': 'Niet mogelijk naar bestand te schrijven',
            'Unable to create archive': 'Niet mogelijk archief te creeëren',
            'Unable to extract files from archive': 'Niet mogelijk bestanden uit te pakken',
            'Unable to open broken link': 'Niet mogelijk .. url te openen',
            'File URL disabled by connector config': 'Bestands url is niet ingeschakeld in de backend configuratie',
            /* statusbar */
            'items': '',
            'selected items': 'Geselecteerde items',
            /* commands/buttons */
            'Back': 'Terug',
            'Reload': 'Herlaad',
            'Open': 'Openen',
            'Preview with Quick Look': 'Voorbeeld met Quick Look',
            'Select file': 'Selecteer bestand',
            'New folder': 'Nieuwe folder',
            'New text file': 'Nieuw tekstbestand',
            'Upload files': 'Upload bestanden',
            'Copy': 'Kopieer',
            'Cut': 'Knip',
            'Paste': 'Plak',
            'Duplicate': 'Directe kopie',
            'Remove': 'Verwijder',
            'Rename': 'Hernoem',
            'Edit text file': 'Bewerk tekst bestand',
            'View as icons': 'Bekijk als icon',
            'View as list': 'Bekijk als lijst',
            'Resize image': 'Afbeelding schalen',
            'Create archive': 'Maak archief',
            'Uncompress archive': 'Uitpakken archief',
            'Get info': 'Verkrijg info',
            'Help': 'Help',
            'Dock/undock filemanager window': '',
            /* upload/get info dialogs */
            'Maximum allowed files size': 'Maximum toegelaten bestandsgrote',
            'Add field': 'Toevoegen veld',
            'File info': 'Bestandsinfo',
            'Folder info': 'Map info',
            'Name': 'Naam',
            'Kind': 'Type',
            'Size': 'Grootte',
            'Modified': 'Aangepast',
            'Permissions': 'Toestemmingen',
            'Link to': 'Link naar',
            'Dimensions': 'Formaat',
            'Confirmation required': 'Bevestiging verplicht',
            'Are you sure you want to remove files?<br /> This cannot be undone!': 'Ben je zeker dat je deze bestanden wilt verwijderen?<br />Dit kan niet ongedaan gemaakt worden!',
            /* permissions */
            'read': 'lees',
            'write': 'schrijf',
            'remove': 'verwijder',
            /* dates */
            'Jan': '',
            'Feb': '',
            'Mar': '',
            'Apr': '',
            'May': '',
            'Jun': '',
            'Jul': '',
            'Aug': '',
            'Sep': '',
            'Oct': '',
            'Nov': '',
            'Dec': '',
            'Today': 'Vandaag',
            'Yesterday': 'Gisteren',
            /* mimetypes */
            'Unknown': 'Onbekend',
            'Folder': 'Map',
            'Alias': '',
            'Broken alias': '',
            'Plain text': '',
            'Postscript document': '',
            'Application': 'Applicatie',
            'Microsoft Office document': '',
            'Microsoft Word document': '',
            'Microsoft Excel document': '',
            'Microsoft Powerpoint presentation': '',
            'Open Office document': '',
            'Flash application': '',
            'XML document': '',
            'Bittorrent file': 'Bittorrent bestand',
            '7z archive': '',
            'TAR archive': 'TAR archief',
            'GZIP archive': 'GZIP archief',
            'BZIP archive': 'BZIP archief',
            'ZIP archive': 'ZIP archief',
            'RAR archive': 'RAR archief',
            'Javascript application': 'Javascript applicatie',
            'PHP source': 'PHP code',
            'HTML document': 'HTML document',
            'Javascript source': 'Javascript code',
            'CSS style sheet': 'CSS style sheet',
            'C source': 'C code',
            'C++ source': 'C++ code',
            'Unix shell script': '',
            'Python source': 'Python code',
            'Java source': 'Java code',
            'Ruby source': 'Ruby code',
            'Perl script': 'Perl code',
            'BMP image': 'BMP afbeelding',
            'JPEG image': 'JPEG afbeelding',
            'GIF Image': 'GIF afbeelding',
            'PNG Image': 'PNG afbeelding',
            'TIFF image': 'TIFF afbeelding',
            'TGA image': 'TGA afbeelding',
            'Adobe Photoshop image': 'Adobe Photoshop afbeelding',
            'MPEG audio': 'MPEG geluidsfragment',
            'MIDI audio': 'MIDI geluidsfragment',
            'Ogg Vorbis audio': 'Ogg Vorbis geluidsfragment',
            'MP4 audio': 'MP4 geluidsfragment',
            'WAV audio': 'WAV geluidsfragment',
            'DV video': 'DV videofragment',
            'MP4 video': 'MP4 videofragment',
            'MPEG video': 'MPEG videofragment',
            'AVI video': 'AVI videofragment',
            'Quicktime video': 'Quicktime videofragment',
            'WM video': 'WM videofragment',
            'Flash video': 'Flash videofragment',
            'Matroska video': 'Matroska videofragment',
            // 'Shortcuts' : 'Клавиши',		
            'Select all files': 'Selecteer alle bestanden',
            'Copy/Cut/Paste files': 'Kopieer/Knip/Plak bestanden',
            'Open selected file/folder': 'Open geselecteerd bestand/folder',
            'Open/close QuickLook window': 'Open/sluit quicklook venster',
            'Remove selected files': 'Verwijder geselecteerde bestanden',
            'Selected files or current directory info': 'Selecteer bestanden of huidige map info',
            'Create new directory': 'Maak nieuwe map',
            'Open upload files form': 'Open upload bestanden formulier',
            'Select previous file': 'Selecteer vorige bestand',
            'Select next file': 'Selecteer volgend bestand',
            'Return into previous folder': 'Ga terug in vorige folder',
            'Increase/decrease files selection': 'Verhoog/verlaag bestands selectie',
            'Authors': 'Auteur',
            'Sponsors': '',
            'elFinder: Web file manager': 'elFinder: Web Bestandsmanager',
            'Version': 'Versie',
            'Copyright: Studio 42 LTD': '',
            'Donate to support project development': '',
            'Javascripts/PHP programming: Dmitry (dio) Levashov, dio@std42.ru': '',
            'Python programming, techsupport: Troex Nevelin, troex@fury.scancode.ru': '',
            'Design: Valentin Razumnih': 'Ontwerp: Valentin Razumnih',
            'Spanish localization': '',
            'Icons': 'Icoons',
            'License: BSD License': 'Licentie: BSD Licentie',
            'elFinder documentation': 'elFinder documentatie',
            'Simple and usefull Content Management System': 'Simpel en handig inhouds management',
            'Support project development and we will place here info about you': 'Steun project ontwikkeling en we plaatsen hier info over jou',
            'Contacts us if you need help integrating elFinder in you products': 'Neem contact met ons op indien je onze hulp nodig hebt bij het integreren van elFinder in jou producten.',
            'helpText': ''
        };
})(jQuery);
