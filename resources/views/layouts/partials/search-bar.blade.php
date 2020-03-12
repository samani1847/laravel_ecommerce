<div class="row" style="margin-bottom:30px">
                <div class="col-2">
                </div>
                <div class="col-6">
                <form method="get" action="{{ url('/search')}}">
                            
                    <div class="form-group">
                        <div class="input-group">
                            {{ csrf_field() }}
                            <input class="form-control" type="text" name="key" placeholder="Search" value="{{ app('request')->input('key') }}" required/>
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i><span style="margin-left:10px;">Search</span></button>
                                </span>
                            </span>

                            
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <script>

            </script>