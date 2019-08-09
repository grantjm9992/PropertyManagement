@inject('translator', 'App\Providers\TranslationProvider')
@if ( $user->role == "SA" )
<div class="container-fluid">
    <div class="row">
            <h5 class="width100">Popular actions</h5>
            <div class="col-12 col-lg-4">
                <a class="btn btn-black width100" href="Users.new">
                    <i class="fas fa-user-plus"></i> Add User
                </a>
            </div>
            <div class="col-12 col-lg-4">
                <a class="btn btn-black width100" href="Admin.viewAs">
                    <i class="fas fa-user-secret"></i> Virtual Session
                </a>
            </div>
            <div class="col-12 col-lg-4">
                <a class="btn btn-black width100" href="Users.new">
                    <i class="fas fa-user-plus"></i> Add User
                </a>
            </div>
        </div>
    </div>
    <div class="row">                
        <div class="col-12 cols-sample-area">                                  				
            <div id="container" style="width: 100%;"></div> 					                   
        </div>				
    </div>
</div>  
    <div id="Tooltip" style="display: none;">
		<div id="icon">	
            <div id="eficon">
			</div>
	    </div>
        <div id="value">
            <div>
               <label id="efpercentage">&nbsp;#point.y#
			   </label>
               <label id="ef">Rentals
			   </label>
            </div>
        </div>
    </div>
	 
  <script type="text/javascript" language="javascript">
    function getMonth(val)
    {
        if ( val == "1" )
        {
            return "January";
        }
        else
        {
            return "NOT";
        }
    }
    $(function ()
	{
        $("#container").ejChart(
        {
		    //Initializing Primary X Axis	
		    primaryXAxis:
            {
                labelFormat: getMonth("{value}"),
			    range: { min: 1, max: 7, interval: 1 },
                title: { text: 'Month' },
				valueType:'category'
            },	
			
			//Initializing Primary Y Axis	
            primaryYAxis:
            {
                labelFormat: "{value}",
                title: { text: 'Rentals' },
                range: { min: 25, max: 50, interval: 5 }
            },	
			
			//Initializing Common Properties for all the series
            commonSeriesOptions: 
			{
                type: 'line', enableAnimation: true,
				tooltip:{ visible :true, template:'Tooltip'},
                marker:
                {
                    shape: 'circle',
                    size:
                    {
                        height: 10, width: 10
                    },
                    visible: true
                },
                 border : {width: 2}                             
            },	
			
            //Initializing Series				
            series: 
			[
			    {
                points: [{ x: 1, y: 28 }, { x: 2, y: 25 },{ x: 3, y: 26 }, { x: 4, y: 27 }, 
						 { x: 5, y: 32 }, { x: 6, y: 35 }, { x: 7, y: 30 }],						 
                name: 'Area Manager 1'
                },						
                {
                points: [{ x: 1, y: 31 }, { x: 2, y: 28 },{ x: 3, y: 30 }, { x: 4, y: 36 }, 
						 { x: 5, y: 36 }, { x: 6, y: 39 }, { x: 7, y: 37 }],						 
                name: 'Area Manager 2'
                },
				{
                points: [{ x: 1, y: 36 }, { x: 2, y: 32 },{ x: 3, y: 34 }, { x: 4, y: 41 }, 
						 { x: 5, y: 42 }, { x: 6, y: 42 }, { x: 7, y: 43 }],						 
                name: 'Area Manager 3'
                },					
                {
                points: [{ x: 1, y: 39 }, { x: 2, y: 36 },{ x: 3, y: 40 }, { x: 4, y: 44 }, 
						 { x: 5, y: 45 }, { x: 6, y: 48 }, { x: 7, y: 46 }],						 
                name: 'Area Manager 4'
				}
			],
            isResponsive: true,
			load:"loadTheme",
            title :{text: 'Rentals per month'},
            size: { height: "600" },
            legend: { visible: true}
        });
    });	 
  </script>
  <style class="cssStyles">
        label{
		margin-bottom : -25px !important ;
		text-align :center !important;
		}
        .tooltipDivcontainer {
            background-color:#E94649;        
            color: white;
			width:130px;
        }
        #Tooltip >div:first-child {
            float: left;
        }
        #Tooltip #value {
            float: right;
            height: 50px;
            width: 68px;
        }
        #Tooltip #value >div {
            margin: 5px 5px 5px 5px;            
        }
        #Tooltip #efpercentage {
            font-size: 20px;
            font-family: segoe ui;
			padding-left: 2px;
        }
         #Tooltip #ef {
            font-size: 12px;
            font-family: segoe ui;
        }
        #eficon {
            background-image: url("../content/images/chart/eficon.png");
            height: 60px;           
            width: 60px;
            background-repeat: no-repeat;
        }
        .cols-sample-area
        {
            margin-top: 25px;
        }
  </style>	
@elseif ( $user->role == "WA" )

@elseif ( $user->role == "AA" )
<div class="container-fluid">
    <div class="row">
            <h5 class="width100">Popular actions</h5>
            <div class="col-12 col-lg-4">
                <a class="btn btn-black width100" href="Users.new">
                    <i class="fas fa-user-plus"></i> Add User
                </a>
            </div>
            <div class="col-12 col-lg-4">
                <a class="btn btn-black width100" href="Admin.viewAs">
                    <i class="fas fa-user-secret"></i> Virtual Session
                </a>
            </div>
            <div class="col-12 col-lg-4">
                <a class="btn btn-black width100" href="Users.new">
                    <i class="fas fa-user-plus"></i> Add User
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xl-4">
            <h5><i class="fas fa-calendar"></i> Arrivals</h5>
            {!! $arrivals !!}
        </div>
        <div class="col-12 col-xl-4">
            <h5><i class="fas fa-envelope"></i> Messages</h5>
            {!! $messages !!}
        </div>
    </div>
</div>
@elseif ( $user->role == "M" )
<div class="container-fluid">
    <div class="row">
            <h5 class="width100">Popular actions</h5>
            <div class="col-12 col-lg-4">
                <a class="btn btn-black width100" href="Users.new">
                    <i class="fas fa-user-plus"></i> Add User
                </a>
            </div>
            <div class="col-12 col-lg-4">
                <a class="btn btn-black width100" href="Admin.viewAs">
                    <i class="fas fa-user-secret"></i> View as Propery Owner
                </a>
            </div>
            <div class="col-12 col-lg-4">
                <a class="btn btn-black width100" href="Users.new">
                    <i class="fas fa-user-plus"></i> Add User
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xl-4">
            <h5><i class="fas fa-calendar"></i> Arrivals</h5>
            {!! $arrivals !!}
        </div>
        <div class="col-12 col-xl-4">
            <h5><i class="fas fa-envelope"></i> Messages</h5>
            {!! $messages !!}
        </div>
    </div>
</div>
@elseif ( $user->role == "PO" )

@endif
