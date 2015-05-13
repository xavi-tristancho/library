<?php namespace Library\Resources\Managers;

use Library\Http\Requests\Request;

class CreateManagerRequest extends Request {

    use \Library\Http\Responses\ApiResponses;

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
            'name' => 'required|unique:managers'
        ];
    }

    public function response(array $errors)
    {
        return $this->setStatusCode(422)->respondWithError('The manager name is already in use');
    }

}
