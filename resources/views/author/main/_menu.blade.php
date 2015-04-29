        <fieldset>
            <legend> Menu</legend>
            <ul style="padding-left: 15px;">
                <li> {{trans($VN.'documents')}}
                    <ul style="padding-left: 15px;">
                        <li>
                            <a href="{{ route('author.folders.index') }}">{{trans($VN.'folders')}}</a>
                        </li>
                        <li>
                            <a href="{{ route('author.documents.index') }}">{{trans($VN.'documents')}}</a>
                        </li>
                        <li>
                            <a href="{{ route('author.frontpages.index') }}">{{trans($VN.'frontpages')}}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </fieldset>
    </div>

