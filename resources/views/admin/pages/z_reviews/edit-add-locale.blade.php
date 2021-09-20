<div class="col-md-12">
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">{{ __("admin_global.label_general_info") }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                        data-toggle="tooltip"
                        title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">{{ __("admin_table.z_reviews.attr_name") }}</label>
                        <input type="text" id="name" name="name"
                               class="form-control"
                               value="{{ old("name", $data->name) }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="author">{{ __("admin_table.z_reviews.attr_author") }}</label>
                        <input type="text" id="author" name="author"
                               class="form-control"
                               value="{{ old("author", $data->author) }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="rating">{{ __("admin_table.z_reviews.attr_rating") }}</label>
                        <select id="rating" name="rating" class="form-control">
                            @for($i = 0; $i <= 5; ($i+=0.5))
                                <option value="{{ $i }}" {{ ($data->rating == $i) ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="review_date">{{ __("admin_table.z_reviews.attr_review_date") }}</label>
                        <input type="date" id="review_date" name="review_date"
                               class="form-control"
                               value="{{ old("review_date", $data->review_date) }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="content">{{ __("admin_global.attr_content") }}</label>
                        <textarea id="content" name="content"
                                  class="form-control editor">{{  old("content", $data->content) }}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    @include("admin.includes.image-edit-add-field", ['image' => old('image', $data->image)])
                </div>

            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
