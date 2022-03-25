<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="{{route("dashboard.".guard())}}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="{{route(guard().".profile")}}" aria-expanded="false"><i class="mdi mdi-account-check"></i><span class="hide-menu">Profile</span></a>
                        </li>
                        @admin
                         <li> <a class="waves-effect waves-dark" href="{{route("admin.department.index")}}" aria-expanded="false"><i class="mdi mdi-group"></i><span class="hide-menu">Departments</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="{{route("admin.teacher.index")}}" aria-expanded="false"><i class="mdi mdi-account-star"></i><span class="hide-menu">Teachers</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="{{route("admin.student.index")}}" aria-expanded="false"><i class="mdi mdi-school"></i><span class="hide-menu">Students</span></a>
                        </li>
                        @endadmin
                        
                        @teacher
                        <li> 
                            <a class="waves-effect waves-dark" href="{{route("teacher.course.index")}}" aria-expanded="false"><i class="mdi mdi-book"></i><span class="hide-menu">Courses</span></a>
                        </li>
                        <li> 
                            <a class="waves-effect waves-dark" href="{{route("teacher.exam.index")}}" aria-expanded="false"><i class="mdi mdi-pen"></i><span class="hide-menu">Exams</span></a>
                        </li>
                        @endteacher

                        @student
                        <li> 
                            <a class="waves-effect waves-dark" href="{{route("student.course.index")}}" aria-expanded="false"><i class="mdi mdi-school"></i><span class="hide-menu">My Courses</span></a>
                        </li>
                        @endstudent

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item--><a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <!-- item--><a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                <!-- item--><a class="link" data-toggle="tooltip" title="Logout" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="mdi mdi-power"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
             </div>
            <!-- End Bottom points-->
        </aside>