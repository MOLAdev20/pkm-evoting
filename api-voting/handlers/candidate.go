package handlers

import (
	"api-voting/models"
	"api-voting/utility"
	"net/http"

	"github.com/gin-gonic/gin"
)

func GetCandidates(c *gin.Context) {
	c.JSON(http.StatusOK, gin.H{
		"message": "List of candidates",
	})
}

func InsertCandidate(c *gin.Context) {
	var candidate models.Candidate

	if err := c.ShouldBindJSON(&candidate); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	if err := utility.DB.Create(&candidate).Error; err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": err.Error()})
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"message": "Candidate inserted successfully",
	})
}
