"use client";

import { FormEvent } from "react";
import { Lock, User } from "lucide-react";

import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { CardContent } from "@/components/ui/card";
import { Label } from "@/components/ui/label";

import Axios from "axios";

export default function FormLogin() {
  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const formData = new FormData(e.currentTarget);
    const username = formData.get("username");
    const password = formData.get("password");

    console.log(process.env.NEXT_PUBLIC_BACKEND_URL)
    
  };

  return (
    <CardContent>
      <form className="space-y-5" onSubmit={handleSubmit}>
        {/* Username */}
        <div className="space-y-2">
          <Label
            htmlFor="username"
            className="text-xs font-medium text-slate-700"
          >
            Username
          </Label>
          <div className="relative">
            <span className="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
              <User className="h-4 w-4" />
            </span>
            <Input
              id="username"
              name="username"
              placeholder="Masukkan username"
              autoComplete="username"
              className="border-slate-200 bg-white pl-9 text-sm text-slate-900 placeholder:text-slate-400 focus-visible:ring-slate-900"
              required
            />
          </div>
        </div>

        {/* Password */}
        <div className="space-y-2">
          <Label
            htmlFor="password"
            className="text-xs font-medium text-slate-700"
          >
            Password
          </Label>
          <div className="relative">
            <span className="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
              <Lock className="h-4 w-4" />
            </span>
            <Input
              id="password"
              name="password"
              type="password"
              placeholder="••••••••"
              autoComplete="current-password"
              className="border-slate-200 bg-white pl-9 text-sm text-slate-900 placeholder:text-slate-400 focus-visible:ring-slate-900"
              required
            />
          </div>
        </div>

        {/* Helper row */}
        <div className="flex items-center justify-between text-[11px] text-slate-500">
          <span>Pastikan data yang kamu masukkan sudah benar.</span>
          <button
            type="button"
            className="font-medium text-slate-800 underline-offset-4 hover:underline"
          >
            Lupa password?
          </button>
        </div>

        {/* Tombol submit */}
        <Button
          type="submit"
          className="mt-1 h-10 w-full rounded-md bg-slate-900 text-sm font-medium text-white hover:bg-slate-800"
        >
          Masuk
        </Button>
      </form>
    </CardContent>
  );
}
