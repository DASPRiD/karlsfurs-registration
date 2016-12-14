$(function(){
    $('a.add-attendee').on('click', function (e) {
        e.preventDefault();

        var firstFieldset = $('#attendee-form').find('fieldset').first();
        var lastFieldset = $('#attendee-form').find('fieldset').last();
        var lastIndex = parseInt(lastFieldset.find('input[name$=\\[name\\]]').attr('name').match(/\[(\d+)\]/)[1]);
        var nextIndex = lastIndex + 1;

        var newFieldset = firstFieldset.clone();

        var nameInput = newFieldset.find('input[name$=\\[name\\]]');
        var groupInput = newFieldset.find('select[name$=\\[group\\]]');
        var walkStatusInput = newFieldset.find('select[name$=\\[walkStatus\\]]');
        var dinnerStatusInput = newFieldset.find('select[name$=\\[dinnerStatus\\]]');

        nameInput.val('');
        nameInput.attr('name', nameInput.attr('name').replace(/\[\d+\]/, '[' + nextIndex + ']'));

        groupInput.val(groupInput.find('option:first-child').attr('value'));
        groupInput.attr('name', groupInput.attr('name').replace(/\[\d+\]/, '[' + nextIndex + ']'));

        walkStatusInput.val('no');
        walkStatusInput.attr('name', walkStatusInput.attr('name').replace(/\[\d+\]/, '[' + nextIndex + ']'));

        dinnerStatusInput.val('no');
        dinnerStatusInput.attr('name', dinnerStatusInput.attr('name').replace(/\[\d+\]/, '[' + nextIndex + ']'));

        lastFieldset.after(newFieldset);
    });

    $(document).on('click', 'a.remove-attendee', function (e) {
        e.preventDefault();
        $(this).parents('fieldset').remove();
    });
});