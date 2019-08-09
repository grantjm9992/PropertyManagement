@inject('translator', 'App\Providers\TranslationProvider')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="row" style="border: 2px solid #e1e1e1; border-radius: 4px;">
				<div class="form-group col-12">
					<label for="Search">Search</label>
					<input type="text" class="form-control" id="query">
				</div>
				<div class="form-group col-12 col-md-6">
					<label for="when">Timeframe</label>
					<select name="when" id="when" class="form-control">
						<option value="1">Upcoming events</option>
						<option value="-1">Past events</option>
						<option value="0">All events</option>
					</select>
				</div>
				<div class="form-group col-12 col-md-6">
					<div class="btn btn-primary" style="margin-top: 32px;" onclick="filter()">
						Filter
					</div>
				</div>
			</div>
			<div id="table" class="row">
				{!! $table !!}
			</div>
		</div>
	</div>
</div>

<script>
	function filter()
	{
		$.ajax({
			type: "POST",
			url: "Events.eventTable",
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			data: {
				query: $('#query').val(),
				when: $('#when').val()
			},
			success: function(data)
			{
				$('#table').html(data);
			}
		})
	}
</script>

<style>
	table{
		width: 100%;
	}
</style>