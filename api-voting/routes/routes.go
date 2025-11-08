package routes

import (
	"api-voting/handlers"
	"api-voting/handlers/student"

	"github.com/gin-gonic/gin"
)

func SetupRouter() *gin.Engine {
	r := gin.Default()

	candidateRoutes := r.Group("/candidates")
	{
		candidateRoutes.GET("/", handlers.GetCandidates)
		candidateRoutes.POST("/", handlers.InsertCandidate)
	}

	participantRoutes := r.Group("/participant")
	{
		participantRoutes.POST("/", handlers.CreateParticipant)
	}

	votingRoutes := r.Group("/voting")
	{
		votingRoutes.POST("/", handlers.InsertVoting)
	}

	studentRoutes := r.Group("/student")
	{
		studentRoutes.POST("/", student.CreateStudent)
	}

	return r
}
