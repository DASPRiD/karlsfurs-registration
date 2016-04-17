<?php
return [
    'language-code' => 'en',
    'furbase-thread' => 'Furbase thread',
    'telegram-group' => 'Telegram group',
    'email-address' => 'Email address',
    'login' => 'Login',
    'logout' => 'Logout',
    'logged-in-as' => 'Logged in as {emailAddress}',
    'registration-and-attendees' => 'Registration and attendees',
    'lead-paragraph' => '
        The next suitwalk will be on <strong>{nextDate, date, long}</strong>. For additional details, like gathering
        place, procedure and times, please refer to the  <a href="{furbaseThreadUrl}">Furbase thread</a>.
    ',
    'registration-hint' => '
        To register for the Karlsfurs Suitwalk, please log in above with your email address. You will receive a link
        via email with which you can add yourself to the list.
    ',
    'login-email-subject' => 'Karlsfurs Suitwalk login',
    'login-email-body' => '
        Hello!

        To register for the Karlsfurs Suitwalk, please folow this link:
        {loginUrl}
    ',
    'invalid-email-address' => 'You have entered an invalid email address.',
    'invalid-token' => 'This link is not valid anymore, please request a new one.',
    'email-sent' => 'An email with additional instructions has been sent to you.',
    'name' => 'Name',
    'group' => 'Group',
    'walk' => 'Walk',
    'dinner' => 'Dinner',
    'yes' => 'Yes',
    'no' => 'No',
    'maybe' => 'Maybe',
    'change-registration' => 'Change entry',
    'walk-attendees' => 'Walk attendees',
    'suiter' => 'Suiters',
    'spotter' => 'Spotters',
    'photographs' => 'Photographs',
    'guests' => 'Guests',
    'dinner-attendees' => 'Dinner attendees',
    'dinner-attendee-information' => '
        {certainDinnerAttendees, plural,
            =0{<strong>No</strong> person}
            =1{<strong>One</strong> person}
            other{<strong>#</strong> people}
        } confirmed their attendance at dinner, {uncertainDinnerAttendees, plural,
            =0{<strong>no</strong> person doesn\'t}
            =1{<strong>one</strong> person doesn\'t}
            other{<strong>#</strong> people don\'t}
        } know it yet.
    ',
];
