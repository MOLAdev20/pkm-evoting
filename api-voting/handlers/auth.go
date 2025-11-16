package handlers

import (
	"errors"
	"fmt"
	"net/http"
	"time"

	"github.com/gin-gonic/gin"
	"github.com/golang-jwt/jwt/v5"
)

func CreateToken(ctx *gin.Context) {
	t := jwt.NewWithClaims(jwt.SigningMethodHS256, jwt.MapClaims{
		"pesan":   "Ini token JWT kamu",
		"user_id": 1,
		"exp":     time.Now().Add(time.Minute * 2).Unix(),
	})

	finalToken, _ := t.SignedString([]byte("HRVLhrnUMze096UjvV4irR8e8toSqJpXI3x9NprLKd1"))
	ctx.JSON(http.StatusOK, gin.H{"token": finalToken})

}

func VerifyToken(ctx *gin.Context) {

	tokenString, ok := ctx.GetQuery("token")

	// is token exist
	if !ok || tokenString == "" {
		ctx.JSON(http.StatusUnauthorized, gin.H{
			"status": "unauthorized",
		})
		return
	}

	// parse token, check signing method alg
	token, err := jwt.Parse(tokenString, func(t *jwt.Token) (any, error) {
		if _, ok := t.Method.(*jwt.SigningMethodHMAC); !ok {
			return nil, fmt.Errorf("unexpected signing method: %v", t.Header["alg"])
		}
		return []byte("HRVLhrnUMze096UjvV4irR8e8toSqJpXI3x9NprLKd1"), nil
	})

	if err != nil {
		if errors.Is(err, jwt.ErrTokenExpired) {
			ctx.JSON(http.StatusUnauthorized, gin.H{
				"status": "token expired",
			})
			return
		}
		ctx.JSON(http.StatusUnauthorized, gin.H{
			"status": "invalid token",
			"error":  err.Error(),
		})
		return
	}

	// claims = data token yang diinput
	if claims, ok := token.Claims.(jwt.MapClaims); ok && token.Valid {
		ctx.JSON(http.StatusOK, gin.H{
			"status": "token verified",
			"claims": claims,
		})
	} else {
		ctx.JSON(http.StatusUnauthorized, gin.H{
			"status": "unauthorized",
		})
	}

}
