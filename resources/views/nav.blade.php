            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
							{!! Form::open(['action' => array('ReqController@search'),'method'=>'GET']) !!}
                                <input type="text" name="search" class="form-control" placeholder="Search...">
								<br>
                                <span class="input-group-btn">
								
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search">Track</i>
                                </button>
								{!! Form::close() !!}
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>					
					@if(Auth::user())
						<li>
                            <a href="{{ route('home') }}"><i class="fa fa-home fa-fw"></i> Home</a>
                            <!-- /.nav-second-level -->							
                        </li>
						<li>
                            <a href="{{ route('dash') }}"><i class="fa fa-cog fa-fw"></i> Admin View</a>
                            <!-- /.nav-second-level -->							
                        </li>
						<li>
                            <a href="{{ route('dash') }}"><i class="fa fa-user-o fa-fw"></i> User </a>
                            <!-- /.nav-second-level -->					
							<ul>
							<li><a href="{{ route('user.register') }}">New User</a></li>
							<li><a href="{{ route('users.list') }}">Manage User</a></li>
							</ul>
                        </li>						
						<li>
                            <a href="{{ route('rep') }}"><i class="fa fa-book fa-fw"></i> Report </a>
                            <!-- /.nav-second-level -->							
                        </li>						
					@endif 
				   </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->