/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Cahyo
 */

 $(document).ready(function(){
	
	var addCustForm = $("#addCustExternal");
	
	var validator = addCustForm.validate({
		
		rules:{
			// no_hp : { required : true, no_hp : { url : baseURL + "checkPhone", type :"post"} },
			kontak_pasien : { required : true, digits : true, remote : { url : baseURL + "checkPhoneExternal", type :"post"} },
		},
		messages:{
			kontak_pasien : { required : "Wajib Diisi", digits : "Masukkan hanya angka saja", remote : "Nomor ini sudah terdaftar" },		
			spg_id : { required : "Wajib diisi"},
			nama_bidan : { required : "Wajib diisi"},
			alamat_bidan : { required : "Wajib diisi"},
			produk_id : { required : "Wajib diisi"},
			nama_pasien : { required : "Wajib diisi"},
			alamat_pasien : { required : "Wajib diisi"},
			nama_anak : { required : "Wajib diisi"},
			produkanak_id : { required : "Wajib diisi"},
			usia : { required : "Wajib diisi"},



			// no_hp : { required : "This field is required", digits : "Please enter numbers only" },
		}
	});
});
