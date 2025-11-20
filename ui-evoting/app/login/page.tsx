import { Lock } from "lucide-react";

import type { Metadata } from "next";

import {
  Card,
  CardHeader,
  CardTitle,
  CardDescription,
  CardFooter,
} from "@/components/ui/card";
import FormLogin from "./form-login";

export const metadata: Metadata = {
  title: "Login",
};

export default function Login() {

  return (
    <div className="flex min-h-screen items-center justify-center bg-slate-100">
      <div className="mx-4 flex w-full max-w-md flex-col gap-6">
        {/* Header / brand */}
        <div className="flex flex-col items-center gap-2 text-center">
          <div className="flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-white shadow-sm">
            <Lock className="h-5 w-5 text-slate-800" />
          </div>
          <div>
            <p className="text-xs uppercase tracking-[0.18em] text-slate-400">
              Welcome back
            </p>
            <h1 className="text-2xl font-semibold text-slate-900">
              Admin Dashboard
            </h1>
          </div>
        </div>

        {/* Card login */}
        <Card className="border-slate-200 bg-white shadow-md">
          <CardHeader className="space-y-1 pb-4">
            <CardTitle className="text-lg font-semibold text-slate-900">
              Masuk ke akun anda
            </CardTitle>
            <CardDescription className="text-xs text-slate-500">
              Gunakan username dan password yang telah terdaftar.
            </CardDescription>
          </CardHeader>

          <FormLogin/>

          <CardFooter className="flex flex-col gap-1 text-center text-[11px] text-slate-500">
            <p>
              Tips dev: pakai akun demo{" "}
              <span className="font-medium text-slate-900">
                admin / admin123
              </span>
              .
            </p>
          </CardFooter>
        </Card>

        {/* Footer mini */}
        <p className="text-center text-[11px] text-slate-400">
          © {new Date().getFullYear()} Your Company. All rights reserved.
        </p>
      </div>
    </div>
  );
}
