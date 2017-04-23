$('body').on('show.bs.modal', '.modal', function (event) {


	var button = $(event.relatedTarget);

	var modal = $(this);
	var info;

	$.each(button[0].attributes, function() {
		if(this.nodeName.startsWith('data-modal-')) {

			info = this.nodeValue.split(",");

			name = this.nodeName.replace("data-modal-", "");

			switch (info[0]) {
				case 'input':
					modal.find("[name='"+name+"']").val(info[1]);
				break;
			}

			console.log(this.nodeName);
		}
	});


});