<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:400'],
            'content' => ['required', 'string'],
            'video_link' => ['string', 'max:400'],
            'image_gallery_id' => ['required', 'integer', 'exists:Image_galleries,id'],
            'published_at' => [''],
            'type' => ['required', 'in:article,temoignage,evenement'],
            'views' => ['required', 'integer'],
            'like' => ['required', 'integer'],
            'favorite' => ['required', 'integer'],
        ];
    }
}
