(function ($) {
	'use strict';

	function openMediaFrame(button, callback) {
		const frame = wp.media({
			title: 'Selecionar imagem',
			button: { text: 'Usar esta imagem' },
			multiple: false,
		});

		frame.on('select', function () {
			const attachment = frame.state().get('selection').first().toJSON();
			callback(attachment);
		});

		frame.open();
	}

	$(document).on('click', '.liderban-image-select', function (event) {
		event.preventDefault();
		const $field = $(this).closest('.liderban-image-field');

		openMediaFrame($(this), function (attachment) {
			$field.find('.liderban-image-id').val(attachment.id);
			$field.find('.liderban-image-field__preview').html(
				'<img src="' + attachment.url + '" alt="" />'
			);
		});
	});

	$(document).on('click', '.liderban-image-remove', function (event) {
		event.preventDefault();
		const $field = $(this).closest('.liderban-image-field');
		$field.find('.liderban-image-id').val('');
		$field.find('.liderban-image-field__preview').empty();
	});

	$(document).on('click', '.liderban-repeater-image__select', function (event) {
		event.preventDefault();
		const $wrap = $(this).closest('.liderban-repeater-image');

		openMediaFrame($(this), function (attachment) {
			$wrap.find('.liderban-repeater-image__url').val(attachment.url);
			$wrap.find('.liderban-repeater-image__preview').html(
				'<img src="' + attachment.url + '" alt="" />'
			);
			syncRepeater($(this).closest('.liderban-repeater'));
		});
	});

	function syncRepeater($repeater) {
		const items = [];

		$repeater.find('.liderban-repeater__row').each(function () {
			const item = {};
			$(this).find('[data-key]').each(function () {
				item[$(this).data('key')] = $(this).val();
			});
			items.push(item);
		});

		$repeater.find('.liderban-repeater__input').val(JSON.stringify(items));
	}

	$(document).on('input change', '.liderban-repeater__row [data-key]', function () {
		syncRepeater($(this).closest('.liderban-repeater'));
	});

	$(document).on('click', '.liderban-repeater__add', function (event) {
		event.preventDefault();
		const $repeater = $(this).closest('.liderban-repeater');
		const $template = $repeater.find('.liderban-repeater__template').html();
		const index = $repeater.find('.liderban-repeater__row').length;
		const html = $template.replace(/__INDEX__/g, index + 1);
		$repeater.find('.liderban-repeater__items').append(html);
		syncRepeater($repeater);
	});

	$(document).on('click', '.liderban-repeater__remove', function (event) {
		event.preventDefault();
		const $repeater = $(this).closest('.liderban-repeater');
		$(this).closest('.liderban-repeater__row').remove();
		syncRepeater($repeater);
	});

	$('.liderban-repeater').each(function () {
		syncRepeater($(this));
	});
})(jQuery);
