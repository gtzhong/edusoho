define(function(require, exports, module) {

	var Validator = require('bootstrap.validator');
    var Notify = require('common/bootstrap-notify');
	require('common/validator-rules').inject(Validator);

	exports.run = function() {
        var $form = $('#dictionary-form');
		var $modal = $form.parents('.modal');
        var $table = $('#dictionary-table');

		var validator = new Validator({
            element: $form,
            autoSubmit: false,
            onFormValidated: function(error, results, $form) {
                if (error) {
                    return ;
                }

                $.post($form.attr('action'), $form.serialize(), function(html){
                    $modal.modal('hide');
                    location.reload();

                        Notify.success('更新栏目成功！');

                }).fail(function() {

                        Notify.danger("更新栏目成功失败，请重试！");

                });

            }
        });

        validator.addItem({
            element: '#dictionary-name-field',
            required: true,
            rule: 'remote'
        });


        validator.addItem({
            element: '#dictionary-weight-field',
            required: false,
            rule: 'integer'
        });

	};

});