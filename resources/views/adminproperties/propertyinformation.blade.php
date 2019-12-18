<div class="card">
    <div class="card-header">
        <h5>
            Property information
        </h5>
    </div>
    <div class="card-body">
        <div style="height: 20px; border-radius: 50%; position: relative;" class="w-100 mb-4">
            <div style="height: 100%; position: absolute; background-color: mediumspringgreen;left: 0; top: 0;" id="progress"></div>        
        </div>
        <form id="info">
            <input type="text" hidden name="property_id" value="{{ $property->id }}">
            {!! $html !!}
        </form>
    </div>
</div>
<script>
    var i = 0;
    var sections = $('[container-id]');
    $(document).ready( function() {
        $('[container-id]').hide();
        $(sections[0]).show();

    })

    function prev()
    {
        if ( i > 0 )
        {
            i = i-1;
            $(sections).hide();
            $(sections[i]).show();
            updateProgress()
        }
    }
    function next()
    {
        if ( i < sections.length - 1 )
        {
            i = i + 1;
            $(sections).hide();
            $(sections[i]).show();
            updateProgress()
        }
    }

    function updateProgress()
    {
        var progress = 100*i/sections.length+"%";

        $("#progress").css("width", progress );
    }

    function submit()
    {
        $.ajax({
            type: "POST",
            url: "PropertyInformation.saveData",
            data: $('#info').serialize(),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data)
            {
                if ( data == "OK" )
                {
                    alert("OK");
                }
            }
        })
    }
        
</script>

<style>
#progress
{
    transition: 1s ease all;
}
.inputGroup {
    background-color: #fff;
    display: block;
    margin: 10px 0;
    position: relative;
}
  .inputGroup label {
      padding: 12px 30px;
      width: 100%;
      display: block;
      text-align: left;
      color: #3C454C;
      cursor: pointer;
      position: relative;
      z-index: 2;
      transition: color 200ms ease-in;
      overflow: hidden;
  }
      .inputGroup label:before {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        content: '';
        background-color: #5562eb;
        border-radius: 8px;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%) scale3d(1, 1, 1);
        transition: all 300ms cubic-bezier(0.4, 0.0, 0.2, 1);
        opacity: 0;
        z-index: -1;
      }

      .inputGroup label:after {
        width: 32px;
        height: 32px;
        content: '';
        border: 2px solid #D1D7DC;
        background-color: #fff;
        background-image: url("data:image/svg+xml,%3Csvg width='32' height='32' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.414 11L4 12.414l5.414 5.414L20.828 6.414 19.414 5l-10 10z' fill='%23fff' fill-rule='nonzero'/%3E%3C/svg%3E ");
        background-repeat: no-repeat;
        background-position: 2px 3px;
        border-radius: 50%;
        z-index: 2;
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        transition: all 200ms ease-in;
      }


    input:checked ~ label {
      color: #fff;
    }
    input:checked ~ label:before {
        transform: translate(-50%, -50%) scale3d(56, 56, 1);
        opacity: 1;
      }

      input:checked ~ label:after {
        background-color: #54E0C7;
        border-color: #54E0C7;
        border-radius: 8px;
      }
    

    input[type="radio"] {
      width: 32px;
      height: 32px;
      order: 1;
      z-index: 2;
      position: absolute;
      right: 30px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      visibility: hidden;
    }
  }

</style>