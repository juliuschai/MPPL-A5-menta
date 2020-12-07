var tableElm = $('#tableElm');

var viewBtn = $('#viewBtnTemplate');

tableElm.DataTable({
	processing: true,
	serverSide: true,
	ajax: tableElm.data('ajaxurl'),
	columns: [
		{
            title: 'Id',
			data: 'id',
			name: 'id',
			searchable: false,
			visible: false,
		},
		{
			title: 'Name',
			data: 'name',
			name: 'name',
			searchable: true,
			visible: true,
		},
		{
			title: 'Email',
			data: 'email',
			name: 'email',
			searchable: true,
			visible: true,
		},
		{
			title: 'No. Telp',
			data: 'phone_num',
			name: 'phone_num',
			searchable: true,
			visible: true,
		},
		{
			title: 'Verified',
			data: 'email_verified_at',
			name: 'email_verified_at',
			searchable: true,
            visible: true,
			render: function (data, type, full, meta) {
                if (data) {
                    return 'Ya';
                } else {
                    return 'Tidak';
                }
			}
		},
		{
			title: 'Role',
			data: 'role',
			name: 'role',
			searchable: true,
			visible: true,
		},
		{
			title: 'Aksi',
			data: null,
			name: null,
			searchable: false,
			visible: true,
			render: function (data, type, full, meta) {
				return viewBtn.createButton(full.id).html();
			}
		},
	],
});
