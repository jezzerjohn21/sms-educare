<div class="eoff-form">
    <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('admin.create.subject') }}">
         @csrf
        <div class="form-row">
            <div class="fpb-7">
                <label for="class_id_on_create" class="eForm-label">{{ get_phrase('Class') }}</label>
                <select name="class_id" id="class_id" class="form-select eForm-select eChoice-multiple-with-remove" required>
                    <option value="">{{ get_phrase('Select a class') }}</option>
                     @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="fpb-7">
                <label for="name" class="eForm-label">{{ get_phrase('Name') }}</label>
                <input type="text" class="form-control eForm-control" id="name" name = "name" placeholder="Provide subject name" required>
            </div>

            {{-- <div class="fpb-7">
                <label for="name" class="eForm-label">{{ get_phrase('Asign a tearcher') }}</label>
                <input type="text" class="form-control eForm-control" id="name" name = "teacher" placeholder="select a teacher to handle" required>
            </div> --}}

            <div class="fpb-7">
                <label for="class_id_on_create" class="eForm-label">{{ get_phrase('Asign a tearcher') }}</label>
                <select name="teacher_id" id="teacher_id" class="form-select eForm-select eChoice-multiple-with-remove" required>
                    <option value="">{{ get_phrase('select a teacher to handle') }}</option>
                     @foreach($teacher as $teach)
                    <option value="{{ $teach->id }}">{{ $teach->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- <div class="fpb-7">
                <label for="department_id" class="eForm-label">{{ get_phrase("Department") }}</label>
                <select name="department_id" id="department_id" class="form-select eForm-select eChoice-multiple-with-remove" required>
                    <option value="">{{ get_phrase("Select a department") }}</option>

                </select>
            </div> --}}



            <div class="fpb-7 pt-2">
                <button class="btn-form" type="submit">{{ get_phrase('Create subject') }}</button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    "use strict";
    $(document).ready(function () {
      $(".eChoice-multiple-with-remove").select2();
    });
</script>
