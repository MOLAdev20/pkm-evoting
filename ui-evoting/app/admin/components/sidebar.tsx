"use client";

import Link from "next/link";

const nav = [
  { label: "Dashboard", href: "/osis", icon: "📊" },
  { label: "Data Kandidat", main: "candidate", href: "/admin/candidate", icon: "🧑" },
  { label: "Data Pemilih", href: "/osis/pemilih", icon: "🗳" },
  { label: "Hasil Voting", href: "/osis/hasil", icon: "📈" },
  { label: "Pengaturan", href: "/osis/pengaturan", icon: "⚙️" },
];

export function Sidebar({selected}: {selected: string}) {
  return (
    <aside className="hidden md:flex md:w-64 lg:w-72 shrink-0 flex-col border-r border-slate-100 bg-white">
      {/* Brand */}
      <div className="flex h-16 items-center gap-3 border-b border-slate-100 px-6">
        <div className="h-9 w-9 rounded-2xl bg-slate-900 text-white flex items-center justify-center font-bold">
          O
        </div>
        <div className="flex flex-col">
          <span className="text-sm font-semibold tracking-tight">OSIS Election</span>
          <span className="text-[11px] text-slate-400">Panel Admin Sekolah</span>
        </div>
      </div>

      {/* Nav */}
      <nav className="flex-1 space-y-1 overflow-y-auto px-3 py-4 text-sm">
        <p className="mb-2 px-3 text-[11px] font-semibold uppercase tracking-[0.15em] text-slate-400">
          Navigasi
        </p>

        {nav.map((item) => (
          <Link
            key={item.label}
            href={item.href}
            className={`flex items-center gap-3 rounded-xl px-3 py-2 transition
            ${item.main === selected ? "bg-slate-900 text-white shadow-sm" : "text-slate-600 hover:bg-slate-100/60"}`}
          >
            <span className="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-100 text-[13px]">
              {item.icon}
            </span>
            <span className="font-medium">{item.label}</span>
          </Link>
        ))}

        <div className="mt-4 border-t border-slate-100 pt-4">
          <p className="mb-2 px-3 text-[11px] font-semibold uppercase tracking-[0.15em] text-slate-400">
            Bantuan
          </p>
          <Link
            href="#"
            className="flex items-center gap-3 rounded-xl px-3 py-2 text-slate-600 transition hover:bg-slate-100/60"
          >
            <span className="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-100 text-[13px]">
              📘
            </span>
            <span className="font-medium">Panduan Panitia</span>
          </Link>
        </div>
      </nav>

      {/* Logout */}
      <div className="border-t border-slate-100 px-4 py-3">
        <button className="flex w-full items-center justify-between gap-2 rounded-xl px-3 py-2 text-xs font-medium text-slate-600 transition hover:bg-slate-100">
          <span className="inline-flex items-center gap-2">
            <span className="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-100 text-[13px]">
              ⏏
            </span>
            Keluar
          </span>
          <span className="text-slate-400">&rarr;</span>
        </button>
      </div>
    </aside>
  );
}
