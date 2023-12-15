@section('title', 'Edit Post')
<x-layouts.admin>
    <main>
        <div class="pt-6 px-4">
            <div class="my-4 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-500">Edit Post</h1>
                </div>
            </div>
            @if (session()->has('success'))
                <script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: "{{ session('success') }}"
                    });
                </script>
            @endif
            <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="flex gap-3 lg:flex-row flex-col">
                    <div class="basis-[50%]">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Title</span>
                            </div>
                            <input type="text" name="title" placeholder="Post Title"
                                class="input input-bordered w-full @error('title') input-error @enderror "
                                value="{{ $post->title }}" />
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            @error('slug')
                                <p class="text-red-500 text-xs mt-1">Title already taken</p>
                            @enderror
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Description</span>
                            </div>
                            <input type="text" name="description" placeholder="Post description"
                                value="{{ $post->description }}"
                                class="input input-bordered w-full @error('description') input-error @enderror " />
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Thumbnail</span>
                            </div>
                            @if ($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="thumbnail"
                                    class="max-w-[300px] mb-[10px]">
                            @endif
                            <input type="file" name="thumbnail"
                                class="file-input file-input-bordered w-full max-w-xs @error('thumbnail') file-input-error @enderror" />
                            @error('thumbnail')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </label>
                        @if ($post->image_path)
                            <div class="form-control max-w-xs">
                                <label class="label cursor-pointer">
                                    <span class="label-text">Delete Thumbnail</span>
                                    <input type="checkbox" class="checkbox checkbox-error" name="is_delete_thumbnail" />
                                </label>
                            </div>
                        @endif
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Category</span>
                            </div>
                            <select name="category_id"
                                class="select select-bordered w-full @error('category_id') select-error @enderror">
                                <option disabled selected>Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($post->category_id == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </label>

                    </div>
                    <div class="basis-[50%]">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Content</span>
                            </div>
                        </label>
                        <div id="editor">
                            {!! $post->content !!}
                        </div>
                        @error('content')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <input type="text" class="hidden" id="hidden_input" name="content">
                    </div>
                </div>
                @csrf
                <button id="submit" type="submit"
                    class="btn mt-5 bg-green-500 text-white border-0 hover:bg-green-700">Update
                    Post</button>
            </form>

        </div>
    </main>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/super-build/ckeditor.js"></script>
    <script>
        let editor;
        CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline',
                    'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed',
                    '|', 'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [{
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            mention: {
                feeds: [{
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                        '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                        '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                        '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }]
            },
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                'AIAssistant',
                'CKBox',
                'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on production website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                // 'Base64UploadAdapter',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                'MathType',
                // The following features are part of the Productivity Pack and require additional license.
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents',
                'PasteFromOfficeEnhanced'
            ]
        }).then((newEditor) => {
            editor = newEditor;
        });
    </script>
    <script>
        const content_input = document.getElementById('hidden_input');
        document.querySelector('#submit').addEventListener('click', () => {
            const editorData = editor.getData();
            console.log(editorData);
            content_input.value = editorData;
        });
    </script>
</x-layouts.admin>
