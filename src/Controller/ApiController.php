<?php

namespace App\Controller;

use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Doctrine\DBAL\Driver\Connection;
use Symfony\Component\Security\Core\Security;

/**
 * Class ApiController
 *
 * @Route("/api")
 */
class ApiController extends AbstractFOSRestController
{
    private $serializer;
    private $kernel;
    private $connection;
    private $security;

    public function __construct( SerializerInterface $serializer, KernelInterface $kernel, Connection $connection, Security $security)
    {
        $this->serializer = $serializer;
        $this->kernel     = $kernel;
        $this->connection = $connection;
        $this->security   = $security;
    }

    // Documentacion de uso de annotations con swagger
    // https://github.com/zircote/swagger-php/blob/master/Examples/petstore-3.0/controllers/Pet.php
    /**
     * @Rest\Post("/login_check", name="user_login_check")
     *
     * @OA\Response(
     *     response=200,
     *     description="Se ha iniciado sesión exitosamente.",
     *     @OA\JsonContent(
     *         type= "object",
     *         @OA\Property(
     *             property="token",
     *             type="string",
     *             description="Bearer token"
     *         ),
     *         @OA\Property(
     *             property="refresh_token",
     *             type="string",
     *             description="Refresh token"
     *         )
     *     )
     * )
     *
     * @OA\Response(
     *     response=400,
     *     description="Se han encontrado errores en la petición. Debe proveer Usuario y Contraseña."
     * )
     *
     * @OA\Response(
     *     response=500,
     *     description="No se ha podido realizar el inicio de sesión."
     * )
     *
     * @OA\RequestBody(
     *     description="Nombre de usuario y password para autenticación.",
     *     required=true,
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *             type="object",
     *             required={"username", "password"},
     *             @OA\Property(
     *                 property="username",
     *                 description="Nombre de usuario",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 description="Contraseña",
     *                 type="string"
     *             )
     *         )
     *     )
     * )
     *
     * @OA\Tag(name="Usuario")
     */
    public function getLoginCheckAction() {
    }
}