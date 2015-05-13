<?php namespace Library\Resources\Projects;

use Library\Http\Requests\Request;

class CreateProjectRequest extends Request {

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
			'name' => 'required|unique:projects'
		];
	}

	public function response(array $errors)
	{
		return $this->setStatusCode(422)->respondWithError('The project name is already in use');
	}

}
