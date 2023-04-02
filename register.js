$(() => {
	$('#regForm').on('submit', function (event) {
		event.preventDefault();
		const $form = $(event.target);

		const $submit = $form.find('[type="submit"');
		const $formLoader = $('#formLoader');
		$formLoader.show();
		$submit.hide();

		const formData = $form.serializeArray();
		let formattedData = {};
		formData.forEach((item) => {
			formattedData[item.name] = item.value;
		})
		$.ajax({
			url: $form.attr('action'),
			type: 'POST',
			data: formattedData,
			beforeSend: (jqXHR) => {
				jqXHR.setRequestHeader('X-CSRFToken', $('meta[name="csrf-token"]').attr('content'));
			},
			success: function(result) {
				if (result.success) {
					$form.hide();
					const modal = new bootstrap.Modal('#exampleModal', {});
					let message = result.messages.length > 0
						? result.messages.join("<br>")
						: "Успешная регистрация";
					$(modal._element).find('div.modal-body').html(message);
					$(modal._element)
						.find('.modal-footer button')
						.on('click', function () {
							window.location.reload();
						});
					modal.show();
				} else {
					let $errorAlert = $("#errorAlert");
					$errorAlert.show();
					let message = result.messages.length > 0
						? result.messages.join("<br>")
						: "Ошибка регистрации";
					$errorAlert.html(message)
				}
			},
			complete: () => {
				$formLoader.hide();
				$submit.show();
			}
		})
	})
})

//https://developer.mozilla.org/en-US/docs/Web/API/Window/load_event
// window.addEventListener("load", (event) => {
// 	console.log("page is fully loaded");
// });
