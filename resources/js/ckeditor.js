import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
// import { ImageInsert } from "@ckeditor/ckeditor5-image";

ClassicEditor.create(document.querySelector("#editor")).catch((error) => {
    console.error(error);
});
