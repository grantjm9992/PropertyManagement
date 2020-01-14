
@if ( file_exists("data/properties/$property->id/property_information.json") )
<a href="PropertyInformation.download?id_property={{ $property->id }}" target="_blank" class="btn btn-secondary">
    <i class="fas fa-download"></i> Download property information
</a>
@endif
<div class="btn btn-info" onclick="addPropertyTask()">
    <i class="fas fa-calendar"></i> Add task for property
</div>
<a href="Reservations?id_property={{ $property->id }}" class="btn btn-warning">
    <i class="fas fa-calendar"></i> Reservations
</a>
<a href="AdminProperties.clone?id={{ $property->id }}" class="btn btn-success">
    <i class="fas fa-copy"></i> Clone property
</a>
<div class="btn btn-primary" onclick="submitForm()">
    <i class="fas fa-save"></i> Save
</div>
<div class="btn btn-danger" onclick="deleteModel()">
    <i class="fas fa-minus-circle"></i> Delete
</div>