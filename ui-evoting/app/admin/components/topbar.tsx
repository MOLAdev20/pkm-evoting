"use client";

import { Menu } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Sheet, SheetContent, SheetTrigger } from "@/components/ui/sheet";
import { Sidebar } from "./sidebar";

export function Topbar() {
  return (
    <header className="sticky top-0 z-30 border-b border-slate-100 bg-white/80 backdrop-blur">
      <div className="flex h-16 items-center justify-between gap-3 px-4 sm:px-6 lg:px-8">
        <div className="flex items-center gap-3">
          {/* Hamburger mobile */}
          <Sheet>
            <SheetTrigger asChild>
              <Button variant="outline" size="icon" className="md:hidden">
                <Menu className="h-5 w-5" />
              </Button>
            </SheetTrigger>
            <SheetContent side="left" className="w-72 p-0">
              {/* Sidebar untuk drawer mobile */}
              <div className="md:hidden">
                {/* Isi ulang brand di drawer */}
                <div className="flex h-16 items-center gap-3 border-b border-slate-100 px-6">
                  <div className="h-9 w-9 rounded-2xl bg-slate-900 text-white flex items-center justify-center font-bold">
                    O
                  </div>
                  <div className="flex flex-col">
                    <span className="text-sm font-semibold tracking-tight">OSIS Election</span>
                    <span className="text-[11px] text-slate-400">Panel Admin Sekolah</span>
                  </div>
                </div>
                <Sidebar />
              </div>
            </SheetContent>
          </Sheet>

          {/* Judul (desktop) */}
          <div className="hidden sm:flex flex-col">
            <h1 className="text-sm font-semibold tracking-tight text-slate-900">
              Dashboard Pemilihan OSIS
            </h1>
            <p className="text-xs text-slate-400">Ringkasan pemungutan suara & partisipasi siswa</p>
          </div>
        </div>

        {/* Aksi kanan */}
        <div className="flex items-center gap-3">
          {/* Search (desktop) */}
          <div className="hidden w-64 items-center rounded-xl border border-slate-200 bg-slate-50/60 px-3 py-1.5 md:flex">
            <span className="mr-2 text-xs text-slate-400">🔍</span>
            <Input
              placeholder="Cari kandidat / kelas..."
              className="h-6 text-xs outline-none focus-visible:ring-0"
            />
          </div>

          {/* Notif */}
          <button className="relative inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 bg-white text-xs text-slate-500 hover:bg-slate-50">
            🔔
            <span className="absolute -right-0.5 -top-0.5 h-3 w-3 rounded-full border-2 border-white bg-rose-400" />
          </button>

          {/* User */}
          <div className="flex items-center gap-2">
            <div className="hidden flex-col items-end sm:flex">
              <span className="text-xs font-medium text-slate-900">Panitia OSIS</span>
              <span className="text-[11px] text-slate-400">Admin</span>
            </div>
            <div className="flex h-9 w-9 items-center justify-center overflow-hidden rounded-full bg-slate-800 text-xs font-semibold text-white">
              AD
            </div>
          </div>
        </div>
      </div>
    </header>
  );
}
