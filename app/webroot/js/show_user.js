//////  Users/show_users  ////////////
// delete a topoic
$(function(){
	$("#topic_delete").live('click',function(e){
		$(this).parents("#topic_box").animate({width: 'hide', height: 'hide', opacity: 'hide'}, 'slow', function () {
			//disappear
			$(this).children(".span2").attr("style","display:none");
			$(this).children(".span6").attr("style","display:none");

			//display confirm link
			var confirm_link = "<div class='span8'> <p class='delete_confirm'>[delete confirm]"
			                   +"</p></div>";
			$(this).children(".span6").after(confirm_link); //add new div to show confirm link
			$(this).show();
		});
	});
});


/*!
 * jquery.confirm
 *
 * @version 2.0
 *
 * @author My C-Labs
 * @author Matthieu Napoli <matthieu@mnapoli.fr>
 * @author Russel Vela
 *
 * @url http://myclabs.github.io/jquery.confirm/
 */
(function ($) {

    /**
     * Confirm a link or a button
     * @param options {title, text, confirm, cancel, confirmButton, cancelButton, post}
     */
    $.fn.confirm = function (options) {
        if (typeof options === 'undefined') {
            options = {};
        }

        options.button = $(this);

        this.click(function (e) {
            e.preventDefault();

            $.confirm(options, e);
        });

        return this;
    };

    /**
     * Show a confirmation dialog
     * @param options {title, text, confirm, cancel, confirmButton, cancelButton, post}
     */
    $.confirm = function (options, e) {
        // Default options
        var settings = $.extend({
            text: "Are you sure?",
            title: "",
            confirmButton: "Yes",
            cancelButton: "Cancel",
            post: false,
            confirm: function (o) {
                var url = e.currentTarget.attributes['href'].value;
                if (options.post) {
                    var form = $('<form method="post" class="hide" action="' + url + '"></form>');
                    $("body").append(form);
                    form.submit();
                } else {
                    window.location = url;
                }
            },
            cancel: function (o) {
            },
            button: null
        }, options);

        // Modal
        var modalHeader = '';
        if (settings.title !== '') {
            modalHeader =
                '<div class=modal-header>' +
                    '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
                    '<h4 class="modal-title">' + settings.title+'</h4>' +
                '</div>';
        }
        var modalHTML = 
                '<div class="confirmation-modal modal fade" tabindex="-1" role="dialog">' +
                    '<div class="modal-dialog">' +
                        '<div class="modal-content">' +
                            modalHeader +
                            '<div class="modal-body">' + settings.text + '</div>' +
                            '<div class="modal-footer">' +
                                '<button class="confirm btn btn-primary" type="button" data-dismiss="modal">' +
                                    settings.confirmButton +
                                '</button>' +
                                '<button class="cancel btn btn-default" type="button" data-dismiss="modal">' +
                                    settings.cancelButton +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>';
        
        var modal = $(modalHTML);

        modal.on('shown', function () {
            modal.find(".btn-primary:first").focus();
        });
        modal.on('hidden', function () {
            modal.remove();
        });
        modal.find(".confirm").click(function () {
            settings.confirm(settings.button);
        });
        modal.find(".cancel").click(function () {
            settings.cancel(settings.button);
        });

        // Show the modal
        $("body").append(modal);
        modal.modal('show');
    };

})(jQuery);

