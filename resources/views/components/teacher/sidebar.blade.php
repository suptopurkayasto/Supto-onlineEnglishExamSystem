<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a target="_blank" href="{{ config('app.developer.web_url') }}" class="brand-link">
        <img src="{{ Gravatar::get(config('app.developer.email')) }}"
             alt="{{ config('app.developer.name' . ' Image') }}"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.developer.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex border-bottom-0">
            <div class="image">
                <img src="{{ Gravatar::get(auth()->guard('teacher')->user()->email) }}" class="img-circle elevation-2"
                     alt="">
            </div>
            <div class="info">
                <a href="@auth('teacher') {{ route('teacher.dashboard') }} @elseauth('teacher') {{ 'teacher' }} @endauth"
                   class="d-block">
                    @auth('teacher') {{ auth()->guard('teacher')->user()->name }} @endauth
                </a>
            </div>
        </div>


    @auth('teacher')
        @if(auth()->guard('teacher')->user()->profile_status)
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item sidebar-item user-panel has-treeview {{ request()->segment(2) === 'students' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->segment(2) === 'students' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Students
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('teacher.students.index') }}"
                                       class="nav-link {{ request()->url() === route('teacher.students.index') ? 'active' : '' }}">
                                        <i class="fas fa-users nav-icon"></i>
                                        <p>All Students</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('teacher.students.exams.answer-sheets') }}"
                                       class="nav-link {{ request()->url() === route('teacher.students.exams.answer-sheets') ? 'active' : '' }}">
                                        <i class="fas fa-check-circle nav-icon"></i>
                                        <p>Student Answer Sheet</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item sidebar-item user-panel has-treeview {{ request()->segment(2) === 'exams' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->segment(2) === 'exams' ? 'active' : '' }}">
                                <i class="fas fa-diagnoses nav-icon"></i>
                                <p>
                                    Exams
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('teacher.exams.index') }}"
                                       class="nav-link {{ request()->url() === route('teacher.exams.index') ? 'active' : '' }}">
                                        <i class="fas fa-desktop nav-icon"></i>
                                        <p>All Exams</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item sidebar-item user-panel has-treeview {{ request()->segment(2) === 'questions' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->segment(2) === 'questions' ? 'active' : '' }}">
                                <i class="fas fa-question-circle nav-icon"></i>
                                <p>
                                    Questions
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item user-panel">
                                    <a href="{{ route('teachers.questions.grammars.index') }}"
                                       class="nav-link {{ request()->segment(3) === 'grammars' ? 'active' : '' }}">
                                        <i class="fas fa-spell-check nav-icon"></i>
                                        <p>Grammar</p>
                                    </a>
                                </li>


                                <li class="nav-item sidebar-item user-panel has-treeview {{ request()->segment(3) === 'writing' ? 'menu-open' : '' }}">
                                    <a href="#" class="nav-link {{ request()->segment(3) === 'writing' ? 'bg-white' : '' }}">
                                        <i class="fas fa-marker nav-icon"></i>
                                        <p>
                                            Writing
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">

                                        <li class="nav-item">
                                            <a href="{{ route('teachers.questions.dialogs.index') }}"
                                               class="nav-link {{ request()->segment(4) === 'dialogs' ? 'active' : '' }}">
                                                <i class="fas fa-reply-all nav-icon"></i>
                                                <p>Dialog</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('teachers.questions.informal-email.index') }}"
                                               class="nav-link {{ request()->segment(4) === 'informal-email' ? 'active' : '' }}">
                                                <i class="far fa-envelope nav-icon"></i>
                                                <p>Informal Email</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('teachers.questions.formal-email.index') }}"
                                               class="nav-link {{ request()->url() === route('teachers.questions.formal-email.index') ? 'active' : '' }}">
                                                <i class="fas fa-envelope nav-icon"></i>
                                                <p>Formal Email</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('teachers.questions.sort-questions.index') }}"
                                               class="nav-link {{ request()->url() === route('teachers.questions.sort-questions.index') ? 'active' : '' }}">
                                                <i class="fas fa-question nav-icon"></i>
                                                <p>Sort Question</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>


                                <!-- Start::Vocabulary sidebar item markup -->
                                <li class="nav-item sidebar-item user-panel has-treeview {{ request()->segment(3) === 'vocabulary' ? 'menu-open' : '' }}">
                                    <a href="#" class="nav-link {{ request()->segment(3) === 'vocabulary' ? 'bg-white' : '' }}">
                                        <i class="fas fa-drafting-compass nav-icon"></i>
                                        <p>
                                            Vocabulary
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('teachers.questions.synonyms.index') }}"
                                               class="nav-link {{ request()->segment(4) === 'synonyms' ? 'active' : '' }}">
                                                <i class="fas fa-exchange-alt nav-icon"></i>
                                                <p>Synonym</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('teachers.questions.definitions.index') }}"
                                               class="nav-link {{ request()->segment(4) === 'definitions' ? 'active' : '' }}">
                                                <i class="fas fa-pen-square nav-icon"></i>
                                                <p>Definition</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('teachers.questions.combinations.index') }}"
                                               class="nav-link {{ request()->segment(4) === 'combinations' ? 'active' : '' }}">
                                                <i class="fab fa-mix nav-icon"></i>
                                                <p>Combination</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('teachers.questions.fill-in-the-gaps.index') }}"
                                               class="nav-link {{ request()->segment(4) === 'fill-in-the-gaps' ? 'active' : '' }}">
                                                <i class="fas fa-glass-martini-alt nav-icon"></i>
                                                <p>Fill in the gaps</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Start::Vocabulary sidebar item markup -->


                                <!-- Start::Reading sidebar item markup -->
                                <li class="nav-item sidebar-item user-panel has-treeview {{ request()->segment(3) === 'reading' ? 'menu-open' : '' }}">
                                    <a href="#" class="nav-link {{ request()->segment(3) === 'reading' ? 'bg-white' : '' }}">
                                        <i class="fas fa-book-reader nav-icon"></i>
                                        <p>
                                            Reading
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('teachers.questions.headings.index') }}"
                                               class="nav-link {{ request()->segment(4) === 'headings' ? 'active' : '' }}">
                                                <i class="fas fa-heading nav-icon"></i>
                                                <p>Headings</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('teachers.questions.rearranges.index') }}"
                                               class="nav-link {{ request()->segment(4) === 'rearranges' ? 'active' : '' }}">
                                                <i class="fas fa-layer-group nav-icon"></i>
                                                <p>Rearrange</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Start::Reading sidebar item markup -->
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            @endif
        @endauth
    </div>
    <!-- /.sidebar -->
</aside>
