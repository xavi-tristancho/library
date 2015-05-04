<?php namespace Library\Http\Responses;

use Illuminate\Support\Facades\Response;

trait ApiResponses{

    /**
     * Status Code
     * @var integer
     */
    protected $statusCode = 200;

    /**
     * Get the value of Status Code
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set the value of Status Code
     * @param mixed statusCode
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Respond generic method
     * @param  Array $data
     * @param  Array $headers
     * @return Response
     */
    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * Respond with success
     * @param String $message
     * @return Response
     */
    public function respondWithSuccess($message)
    {
        return $this->respond([
            'success' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * Respond with error
     * @param String $message
     * @return Response
     */
    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * Respond Bad Request
     * @param String $message
     * @return Response
     */
    public function respondBadRequest($message = 'Bad Request')
    {
        return $this->setStatusCode(400)->respondWithError($message);
    }

    /**
     * Respond Unauthorized Access
     * @param String $message
     * @return Response
     */
    public function respondUnauthorized($message = 'Unauthorized Access')
    {
        return $this->setStatusCode(401)->respondWithError($message);
    }

    /**
     * Respond not Found
     * @param String $message
     * @return Response
     */
    public function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * Respond Failed Validation
     * @param String $message
     * @return Response
     */
    public function respondFailedValidation($message = 'Validation Failed')
    {
        return $this->setStatusCode(422)->respondWithError($message);
    }

    /**
     * Respond Created
     * @param String $message
     * @return Response
     */
    public function respondUpdated($message = 'Updated')
    {
        return $this->setStatusCode(200)->respondWithSuccess($message);
    }

    /**
     * Respond Deleted
     * @param String $message
     * @return Response
     */
    public function respondDeleted($message = 'Deleted')
    {
        return $this->setStatusCode(200)->respondWithSuccess($message);
    }

    /**
     * Respond Created
     * @param String $message
     * @return Response
     */
    public function respondCreated($message = 'Created')
    {
        return $this->setStatusCode(201)->respondWithSuccess($message);
    }
}
