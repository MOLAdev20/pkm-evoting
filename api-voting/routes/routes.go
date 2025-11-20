package routes

import (
	"api-voting/handlers"
	"time"

	"github.com/gin-contrib/cors"
	"github.com/gin-gonic/gin"
)

func SetupRouter() *gin.Engine {
	r := gin.Default()

	r.Use(cors.New(cors.Config{
		AllowOrigins: []string{"http://localhost:3000"},
		AllowMethods: []string{"GET", "POST"},
		AllowHeaders: []string{"Content-Type", "Authorization"},
		AllowCredentials: true,
		MaxAge: 24 * time.Hour,
	}))

	candidateRoutes := r.Group("/candidates")
	{
		candidateRoutes.GET("/", handlers.GetAllCandidate)
		candidateRoutes.POST("/", handlers.InsertCandidate)
	}

	participantRoutes := r.Group("/participant")
	{
		participantRoutes.GET("/", handlers.GetAllParticipants)
		participantRoutes.POST("/", handlers.CreateParticipant)
	}

	votingRoutes := r.Group("/voting")
	{
		votingRoutes.POST("/", handlers.InsertVoting)
	}

	authRoutes := r.Group("/auth")
	{
		authRoutes.GET("/", handlers.CreateToken)
		authRoutes.GET("/verify-token", handlers.VerifyToken)
	}

	return r
}
