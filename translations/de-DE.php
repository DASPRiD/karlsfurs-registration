<?php
return [
    'language-code' => 'de',
    'furbase-thread' => 'Furbase Thread',
    'telegram-group' => 'Telegram Gruppe',
    'email-address' => 'E-Mail Adresse',
    'login' => 'Anmelden',
    'logout' => 'Abmelden',
    'logged-in-as' => 'Angemeldet als {emailAddress}',
    'registration-and-attendees' => 'Registrierung und Teilnehmer',
    'lead-paragraph' => '
        Der nächste suitwalk findet am <strong>{nextDate, date, long}</strong> statt. Für weitere Details, wie
        Treffpunkt, Ablauf und Zeiten, schau bitte in den entsprechenden
        <a href="{furbaseThreadUrl}">Furbase Thread</a>.
    ',
    'registration-hint' => '
        Um dich für den Karlsfurs Suitwalk zu registrieren, melde dich bitte oben mit deiner E-Mail Adresse an. Du
        erhälst dann einen Link per E-Mail, mit dem du dich in die Liste eintragen kannst.
    ',
    'login-email-subject' => 'Karlsfurs Suitwalk Anmeldung',
    'login-email-body' => '
        Hallo!

        Um dich beim Karlsfurs Suitwalk anzumelden, folge bitte diesem Link:
        {loginUrl}
    ',
    'invalid-email-address' => 'Du hast eine ungültige E-Mail Adresse angegeben.',
    'invalid-token' => 'Dieser Link ist nicht mehr gültig, bitte fordere einen neuen an.',
    'email-sent' => 'Eine E-Mail mit weiteren Instruktionen wurde dir zugesand.',
    'name' => 'Name',
    'group' => 'Gruppe',
    'walk' => 'Walk',
    'dinner' => 'Essen',
    'yes' => 'Ja',
    'no' => 'Nein',
    'maybe' => 'Vielleicht',
    'change-registration' => 'Eintrag ändern',
    'walk-attendees' => 'Walk-Teilnehmer',
    'suiters' => 'Suiter',
    'spotters' => 'Spotter',
    'photographs' => 'Fotografen',
    'guests' => 'Gäste',
    'dinner-attendees' => 'Essen-Teilnehmer',
    'dinner-attendee-information' => '
        Es {certainDinnerAttendees, plural,
            =0{hat sich <strong>keine</strong> Person}
            =1{hat sich <strong>eine</strong> Person}
            other{haben sich <strong>#</strong> Personen}
        } fest zum Essen eingetragen, {uncertainDinnerAttendees, plural,
            =0{<strong>keine</strong> Person weiß}
            =1{<strong>eine</strong> Person weiß}
            other{<strong>#</strong> Personen wissen}
        } es noch nicht.
    ',
];
