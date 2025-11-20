import type { Metadata } from "next";
import { Topbar } from "../components/topbar";
import { Sidebar } from "../components/sidebar";
import { Card } from "@/components/ui/card";

export const metadata: Metadata = {
  title: "Input Kandidat | "+process.env.APP_NAME,
};

export default function Create() {
  return (
    <div className="flex min-h-screen">
      {/* Sidebar desktop */}
      <Sidebar selected="candidate" />

      {/* Main */}
      <div className="flex min-w-0 flex-1 flex-col">
        <Topbar />

        <main className="flex-1 space-y-6 px-4 py-6 sm:px-6 lg:px-8">
          

          {/* Form */}
          <section>
            

            {/* Aktivitas terbaru */}
            <Card className="overflow-hidden rounded-2xl border border-slate-100  shadow-sm xl:col-span-2">
              <div className="flex items-center justify-between border-b border-slate-100 px-4 py-3">
                <div>
                  <h2 className="text-sm font-semibold text-slate-900">Buat Kandidat Baru</h2>
                  <p className="text-xs text-slate-400">Log singkat pemungutan suara & perubahan data</p>
                </div>
              </div>

            </Card>
          </section>
        </main>
      </div>
    </div>
  );
}
