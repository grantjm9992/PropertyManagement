<div class="col-12 col-xl-4" contact="{{ $contact->id }}">
    <div class="container-fluid">
        <div class="contact-card">
            <div class="row text-center">
                <div class="col-12">
                    <i class="fas fa-pencil-alt" style="cursor:pointer;" title="Edit contact" onclick="editContact({{ $contact->id }})"></i>
                    {{ $contact->name }} {{ $contact->surname }}
                </div>
                <div class="col-12">
                    <i class="fas fa-envelope"></i> {{ $contact->email }}
                </div>
                <div class="col-12">
                    <i class="fas fa-phone"></i> {{ $contact->phone }}
                </div>
                <div class="col-12">
                    <div style="margin-top: 10px;" class="btn btn-success" onclick="sendMesage({{ $contact->id }})">
                        <i class="fas fa-envelope"></i> Send Message
                    </div>
                    <a style="margin-top: 10px;" href="tel:{{ $contact->phone }}" class="btn btn-primary md-hide">
                        <i class="fas fa-phone"></i> Call {{ $contact->name }}
                    </a>
                    <div style="margin-top: 10px;" onclick="deletecontact({{ $contact->id }})" class="btn btn-danger">
                        <i class="fas fa-minus-circle"></i> Delete Contact
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>