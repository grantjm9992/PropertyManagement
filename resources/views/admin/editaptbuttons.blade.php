@inject('translator', 'App\Providers\TranslationProvider')
<div class="btn btn-primary" onclick="$('#submit').click()">
	<i class="fas fa-save"></i> Save
</div>
<a href="AdminApartments" class="btn btn-secondary">
	<i class="fas fa-arrow-left"></i> Go back
</a>
<div class="btn btn-danger" onclick="deleteApartment()">
	<i class="fas fa-minus circle"></i> Delete
</div>