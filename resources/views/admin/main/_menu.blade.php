        <fieldset>
            <legend> Menu</legend>
            <ul style="padding-left: 15px;">
                <li> {{trans($VN.'people')}}
                    <ul style="padding-left: 15px;">
                        <li>
                            <a href="{{ route('admin.users.index') }}">{{trans($VN.'users')}}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.departments.index') }}">{{trans($VN.'departments')}}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.roles.index') }}">{{trans($VN.'roles')}}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.permissions.index') }}">{{trans($VN.'permissions')}}</a>
                        </li>
                    </ul>
                </li>
                <li> {{trans($VN.'documents')}}
                    <ul style="padding-left: 15px;">
                        <li>
                            <a href="{{ route('admin.folders.index') }}">{{trans($VN.'folders')}}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.index') }}">{{trans($VN.'categories')}}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.documents.index') }}">{{trans($VN.'documents')}}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.fileentries.index') }}">{{trans($VN.'fileentries')}}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.frontpages.index') }}">{{trans($VN.'frontpages')}}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </fieldset>
    </div>

