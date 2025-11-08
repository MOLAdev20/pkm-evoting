package handlers

import (
	"api-voting/models"
	"api-voting/utility"
	"net/http"

	"github.com/gin-gonic/gin"
)

func InsertVoting(c *gin.Context) {
	var voting models.Voting

	if err := c.ShouldBindJSON(&voting); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	if err := utility.DB.Create(&voting).Error; err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": err.Error()})
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"message": "Voting inserted successfully",
	})
}
