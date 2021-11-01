<div>
    <div class="mx-auto pull-right">
        <div class="">
            <form action="{{ route('companies.index') }}" method="GET" role="search">
                <div class="input-group">
                    <input type="text" class="form-control mr-2" name="term" placeholder="Search companies" id="term">
                    <span class="input-group-btn mr-5">
                        <button class="btn btn-info" type="submit" title="Search companies">
                            <span class="fas fa-search"></span>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>