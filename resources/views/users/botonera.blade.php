<div class="btn btn-primary" onclick="submitForm()">
    <i class="fas fa-save"></i> Save
</div>
<a href="Users" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Back
</a>
@if ( $user->role == "SA" )
<a href="Admin.viewAs?id={{$thisUser->id}}" class="btn btn-success">
    <i class="fas fa-user-secret"></i> View as user
</a>
@endif
<!--
<div class="btn btn-success" onclick="addToContacts()">
    <i class="fas fa-user-plus"></i> Add to contacts
</div>-->
<div class="btn btn-danger" onclick="deleteUser()">
    <i class="fas fa-minus-circle"></i> Delete
</div>